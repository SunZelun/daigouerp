from urllib.request import urlopen, HTTPError, URLError
from bs4 import BeautifulSoup
import requests
import urllib.request
import time
import os
import re
from dateutil import parser
import mysql.connector

fileIndex = 1

def getPageContent(url):
    try:
        webpage = urlopen(url).read()

        return webpage
    except HTTPError as e:
        print(e.code)
        return False
    except URLError as ue:
        print(ue.reason)
        return False


def getPromotion(url, category):
    global fileIndex
    webpage = getPageContent(url)

    if webpage == False:
        print("Error on retrieving URL content")
        return False

    # store html content to offline file
    # player_list_html = open("player_list.html", "w")
    # player_list_html.write(webpage)
    # player_list_html.close()

    # get urls using regex
    # print time.time()
    # urls = re.findall('/players/[a-z]{1}/[a-zA-Z0-9]*.html', webpage)
    # print time.time()

    soup = BeautifulSoup(webpage,"html.parser")
    promoList = soup.find("div",attrs={"class":"tabs1Content"}).find_all('article')
    
    promos = []

    for index, item in enumerate(promoList):
        title = item.find('a', attrs={"rel":"bookmark"}).get_text().lstrip().rstrip()
        url = item.find('a', attrs={"rel":"bookmark"}).get('href')
        idString = item.find('a', attrs={"rel":"bookmark"}).get('href').split('-')[-1].replace("/", "")
        startDate = item.find('span', attrs={"class":"dtstart"}).find('span').get('title')
        endDate = ""

        if item.find('span', attrs={"class":"dtend"}) is not None:
            endDate = item.find('span', attrs={"class":"dtend"}).find('span').get('title')
        
        item = {
            "title": title,
            "url" : url,
            "id": idString,
            "start_date": parser.parse(startDate),
            "end_date": endDate,
            "category": category
        }

        promos.append(item)

    print(promos)
    exit()
    header = soup.find("table",{"id":"stats"}).find("thead")
    paginationUrls = soup.find("div",attrs={"class":"p402_premium"}).find("p").find_all('a')
    nextPageUrl = ""

    #get next page url
    for pagination in paginationUrls:
        if pagination.get_text() == "Next page":
            nextPageUrl = "https://www.basketball-reference.com" + pagination.get('href')

    #add player profile url to array
    for index, t in enumerate(table):
        for target in t.find("td",attrs={"data-stat": "player"}).find_all('a'):
            table[index]["player_url"] = target.get('href')

    #output to csv file
    out = open('players-' + str(fileIndex) + '.csv','w')

    # do find_all on beautifulsoup object
    for j in header.find_all("th",class_="poptip"):
        out.write(j.get_text()+",")
    out.write("Player URL,")
    out.write("\n")

    for i in table:
        d=i.find("th")
        out.write(d.get_text()+",")
        for j in i.find_all("td"):
            out.write(j.get_text()+",")
        out.write(i.attrs.get("player_url")+",")
        out.write("\n")

    out.close()

    print(url)
    print('Done!')

    if nextPageUrl != "":
        time.sleep(1)
        fileIndex += 1
        getPromotion(nextPageUrl)


# start crawling
getPromotion("https://singpromos.com/bydate/ontoday/cosmetics/", "cosmetics")