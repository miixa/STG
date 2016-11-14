#!/usr/local/bin/python
from bs4 import BeautifulSoup as bs
url = 'http://10.8.0.10/storage/index.php'
soup = bs(url, 'html.parser')
print (soup.prettify())
print "test"
