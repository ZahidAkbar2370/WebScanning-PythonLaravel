import json
import requests
import urllib

from flask import Flask, request, jsonify
from bs4 import BeautifulSoup as bs
from urllib.parse import urljoin, urlparse

app = Flask(__name__)

# Define API Keys
urlscan_api_key = 'OkmRUszgikPtn8Rsinl9cc9yfJhIobU0'
subdomain_api_key = "at_vqhfObqlrfSFCpWJEs7W0WEYiVb6G"


# Retrieve forms from the URL
def get_all_forms(url):
    soup = bs(requests.get(url).content, "html.parser")
    return soup.find_all("form")
    
# Retrieve form details
def get_form_details(form):
    details = {}
    
    # get the form action (target url)
    action = form.attrs.get("action", "").lower()
    
    # get the form method (POST, GET, etc.)
    method = form.attrs.get("method", "get").lower()
    
    # get all the input details such as type and name
    inputs = []
    for input_tag in form.find_all("input"):
        input_type = input_tag.attrs.get("type", "text")
        input_name = input_tag.attrs.get("name")
        inputs.append({"type": input_type, "name": input_name})
        
    # put everything to the resulting dictionary
    details["action"] = action
    details["method"] = method
    details["inputs"] = inputs
    return details

# Submit a form for XSS test
def submit_form(form_details, url, value):
    
    # construct the full URL (if the url provided in action is relative)
    target_url = urljoin(url, form_details["action"])
    
    # get the inputs
    inputs = form_details["inputs"]
    data = {}
    for input in inputs:
        
        # replace all text and search values with `value`
        if input["type"] == "text" or input["type"] == "search":
            input["value"] = value
        input_name = input.get("name")
        input_value = input.get("value")
        if input_name and input_value:
            
            # if input name and value are not None, 
            # then add them to the data of form submission
            data[input_name] = input_value
    
    if form_details["method"] == "post":
        return requests.post(target_url, data=data)
    else:
        return requests.get(target_url, params=data)
    
# Detect SQL Injection Vulnerabilities
def is_vulnerable(response):
    errors = {
        # MySQL
        "you have an error in your sql syntax;",
        "warning: mysql",
        # SQL Server
        "unclosed quotation mark after the character string",
        # Oracle
        "quoted string not properly terminated",
    }
    
    for error in errors:
        
        # if you find one of these errors, return True
        if error in response.content.decode().lower():
            return True
        
    return False

# Method for URL Scanning
@app.route('/url_scan', methods=['POST'])
def scan_url():
    
    # Retrieve the URL
    URL = request.get_json()['url']
    
    # Adjustable strictness level from 0 to 2. 0 is the least strict and recommended for most use cases.
    # Higher strictness levels can increase false-positives.
    additional_params = {
        'strictness' : 0
    }
    
    # Write the query
    url = 'https://www.ipqualityscore.com/api/json/url/%s/%s' % (urlscan_api_key, urllib.parse.quote_plus(URL))
    
    # Perform analysis
    result = requests.get(url, params = additional_params)
    result = json.loads(result.text)
    
    if 'success' in result and result['success'] == True:
        
        # retrieve results
        domain = result['domain']
        unsafe = result['unsafe']
        valid_dns = result['dns_valid']
        parking = result['parking']
        spamming = result['spamming']
        malware = result['malware']
        phishing = result['phishing']
        suspicious = result['suspicious']
        adult = result['adult']
        redirected = result['redirected']
        
        # Build the final result
        result = {
            "Domain": f'{domain}',
            "Unsafe": f'{unsafe}',
            "DNS_validity": f'{valid_dns}',
            "Parking_page": f'{parking}',
            "Spamming": f'{spamming}',
            "Malware": f'{malware}',
            "Phishing": f'{phishing}',
            "Suspicious": f'{suspicious}',
            "Adult_content": f'{adult}',
            "Redirected_page": f'{redirected}'
        }
        
        return jsonify({'url_scanning': f'{result}'})
    
 
# Method for XSS Detection
@app.route('/xss', methods=['POST'])
def scan_xss():
    
    # Retrieve the URL
    URL = request.get_json()['url']
    
    # get all the forms from the URL
    forms = get_all_forms(URL)
    js_script = "<Script>alert('hi')</scripT>"
    
    # returning value
    is_vulnerable = False
    
    try:
        # iterate over all forms
        for form in forms:
            form_details = get_form_details(form)
            content = submit_form(form_details, URL, js_script).content.decode()
            if js_script in content:
                is_vulnerable = True
    except:
        is_vulnerable = False
            
    return jsonify({'XSS_vulnerable': f'{is_vulnerable}'})


# Method for XSS Detection
@app.route('/sql', methods=['POST'])
def scan_sql():
    
    # Retrieve the URL
    url = request.get_json()['url']
    
    # initialize an HTTP session & set the browser
    session = requests.Session()
    session.headers["User-Agent"] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Safari/537.36"
    
    # Set vulnerability
    sql_injection_vulnerable = False
    
    try:
        
        # test on URL
        for c in "\"'":
            
            # add quote/double quote character to the URL
            new_url = f"{url}{c}"
            
            # make the HTTP request
            res = session.get(new_url)
            if is_vulnerable(res):
                sql_injection_vulnerable = True
                break
            
        # Perform test on forms
        if sql_injection_vulnerable == False:
            
            # test on HTML forms
            forms = get_all_forms(url)
            
            for form in forms:
                form_details = get_form_details(form)
                for c in "\"'":
                    
                    # the data body we want to submit
                    data = {}
                    for input_tag in form_details["inputs"]:
                        if input_tag["type"] == "hidden" or input_tag["value"]:
                            
                            # any input form that is hidden or has some value,
                            # just use it in the form body
                            try:
                                data[input_tag["name"]] = input_tag["value"] + c
                            except:
                                pass
                        elif input_tag["type"] != "submit":
                            
                            # all others except submit, use some junk data with special character
                            data[input_tag["name"]] = f"test{c}"
                            
                    # join the url with the action (form request URL)
                    url = urljoin(url, form_details["action"])
                    if form_details["method"] == "post":
                        res = session.post(url, data=data)
                    elif form_details["method"] == "get":
                        res = session.get(url, params=data)
                        
                    # test whether the resulting page is vulnerable
                    if is_vulnerable(res):
                        sql_injection_vulnerable = True
                        break
    except:
        sql_injection_vulnerable = False
        
    # Return the result
    return jsonify({'SQL_injection_vulnerable': f'{sql_injection_vulnerable}'})
    
# Method for XSS Detection
@app.route('/subdomain', methods=['POST'])
def scan_sd():
    
    # Retrieve the URL
    URL = request.get_json()['url']
    
    # Phrase the domain
    domain = urlparse(URL).netloc
    domain = domain.replace("www.", "")
    
    # Construct the query
    query = f'https://subdomains.whoisxmlapi.com/api/v1?apiKey={subdomain_api_key}&domainName={domain}'
    response = requests.request("GET", query, headers={}, data={})
    
    # Retrieve results
    result = json.loads(response.text)
    result = result['result']['records']
    
    # Make a list of subdomains
    subdomains = []
    for rslt in result:
        subdomains.append(rslt['domain'])
    
    return jsonify({'Subdomains': f'{subdomains}'})

    
if __name__ == '__main__':
    app.run(debug=True)