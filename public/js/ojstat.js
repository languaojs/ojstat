var ojServ = ojstaturl + "/public/record/index";
var clientEntryTime = new Date;
var ojPageTitle;
var ojBrowser;
var ojOs;
var ojDevice;
var ojRef;
var clientGeoIp;
var clientGeoCity;
var clientGeoRegion;
var clientGeoCountry;
var clientGeoCountryCode;
var clientGeoIsp;
var clientExitTime;

function getGeoLocation(){
    if(!localStorage.getItem("geoIp")){
        getGeo();
    }else{
        getGeoData();
    }
}

async function getGeo(){
    const geoURL = 'https://ipapi.co/json/';
    const response = await fetch(geoURL);
    const data = await response.json();
    const geoIp = data.ip;
    const geoCity = data.city;
    const geoRegion = data.region;
    const geoCountry = data.country_name;
    const geoCountryCode = data.country_code;
    const geoIsp = data.org;
    localStorage.setItem("geoIp", geoIp);
    localStorage.setItem("geoCity", geoCity);
    localStorage.setItem("geoRegion", geoRegion);
    localStorage.setItem("geoCountry", geoCountry);
    localStorage.setItem("geoCountryCode", geoCountryCode);
    localStorage.setItem("geoIsp", geoIsp);
    location.reload();
}

function getGeoData(){
    clientGeoIp = localStorage.getItem("geoIp");
    clientGeoCity = localStorage.getItem("geoCity");
    clientGeoRegion = localStorage.getItem("geoRegion");
    clientGeoCountry = localStorage.getItem("geoCountry");
    clientGeoCountryCode = localStorage.getItem("geoCountryCode");
    clientGeoIsp = localStorage.getItem("geoIsp");
    gatherData();
}

getGeoLocation();

function ojGetBrowser(){
    var nAgt = navigator.userAgent;
    ojBrowser = "Unknown";
    if(nAgt.indexOf("Opera")!=-1){
        ojBrowser = "Opera";
    }else if(nAgt.indexOf("MSIE")!=-1){
        ojBrowser = "Internet Explorer";
    }else if(nAgt.indexOf("Chrome")!=-1){
        ojBrowser = "Chrome";
    }else if(nAgt.indexOf("Safari")!=-1){
        ojBrowser = "Safari";
    }else if(nAgt.indexOf("Firefox")!=-1){
        ojBrowser = "Firefox";
    }else if(nAgt.indexOf(" ")!=-1){
        ojBrowser = navigator.appName;
    }else if(nAgt.indexOf("Edge")!=-1){
        ojBrowser = "Edge";
    }else if(nAgt.indexOf("Monkey")!=-1){
        ojBrowser = "SeaMonkey";
    }else if(nAgt.indexOf("Maxthon")!=-1){
        ojBrowser = "Maxthon";
    }else if(nAgt.indexOf("Vivaldi")!=-1){
        ojBrowser = "Vivaldi";
    }else if(nAgt.indexOf("IceCat")!=-1){
        ojBrowser = "GNU IceCat";
    }else if(nAgt.indexOf("Comodo")!=-1){
        ojBrowser = "Comodo Dragon";
    }else if(nAgt.indexOf("Sleipnir")!=-1){
        ojBrowser = "Sleipnir";
    }else if(nAgt.indexOf("Yandex")!=-1){
        ojBrowser = "Yandex";
    }else if(nAgt.indexOf("Tor")!=-1){
        ojBrowser = "Tor";
    }else if(nAgt.indexOf("Moon")!=-1){
        ojBrowser = "PaleMoon";
    }else if(nAgt.indexOf("Dooble")!=-1){
        ojBrowser = "Dooble";
    }else if(nAgt.indexOf("Crusta")!=-1){
        ojBrowser = "Crusta Browser";
    }else if(nAgt.indexOf("Chromium")!=-1){
        ojBrowser = "Chromium";
    }else if(nAgt.indexOf("360")!=-1){
        ojBrowser = "360 Security Browser";
    }else if(nAgt.indexOf("Baidu")!=-1){
        ojBrowser = "Baidu";
    }else if(nAgt.indexOf("Conkeror")!=-1){
        ojBrowser = "Conkeror";
    }else if(nAgt.indexOf("UC")!=-1){
        ojBrowser = "UC Browser";
    }else if(nAgt.indexOf("NetSurf")!=-1){
        ojBrowser = "NetSurf";
    }
}

function ojGetPageTitle(){
    ojPageTitle = document.getElementsByTagName("title")[0].textContent;
}

function ojGetOs(){
    var nApv = navigator.appVersion;
    ojOs = "Unknown";
    if(nApv.indexOf("Win")!=-1){
        ojOs = "Windows";
    }else if(nApv.indexOf("Mac")!=-1){
        ojOs = "MacOS";
    }else if(nApv.indexOf("X11")!=-1){
        ojOs = "UNIX";
    }else if(nApv.indexOf("Linux")!=-1){
        ojOs = "Linux";
    }else if(nApv.indexOf("Android")!=-1){
        ojOs = "Android";
    }else if(nApv.indexOf("Fedora")!=-1){
        ojOs = "Fedora";
    }else if(nApv.indexOf("Ubuntu")!=-1){
        ojOs = "Ubuntu";
    }else if(nApv.indexOf("Solaris")!=-1){
        ojOs = "Solaris";
    }else if(nApv.indexOf("BSD")!=-1){
        ojOs = "FreeBSD";
    }else if(nApv.indexOf("Debian")!=-1){
        ojOs = "Debian";
    }else if(nApv.indexOf("Cent")!=-1){
        ojOs = "CentOS";
    }
}

function ojGetDevice(){
    var scr = window.screen.width;
    ojDevice = "Unknown";
    if(scr>=1920){
        ojDevice = "Desktop";
    }else if(scr>=1360){
        ojDevice = "Netbook";
    }else if(scr>=790){
        ojDevice = "Tablet";
    }else if(scr>=320){
        ojDevice = "Smartphone";
    }
}

function ojGetRef(){
    ojRefTest = document.referrer;
    if(ojRefTest ==='' || ojRefTest === 'undefined'){
        ojRef = "https://direct.access";
    }else{
        ojRef = document.referrer;
    }
}

function sendReport(ojServUrl, ojObjJson, callback){
    ojObjJson = {
        clientExitTime: new Date - clientEntryTime,
        siteId:ojSiteId,
        pageTitle:ojPageTitle,
        referrer:ojRef,
        browser:ojBrowser,
        os:ojOs,
        device:ojDevice,
        clientIp:clientGeoIp,
        clientCountry:clientGeoCountry,
        clientCountryCode:clientGeoCountryCode,
        clientRegion:clientGeoRegion,
        clientCity:clientGeoCity,
        clientIsp:clientGeoIsp
    }

    var xhr = new XMLHttpRequest();
    var ojServUrl = ojServ;
    xhr.open("POST", ojServUrl);
    xhr.setRequestHeader('Content-type','application/json');
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status ==200){
            if(callback)callback(xhr.responseText);
        }
    }
    xhr.send(JSON.stringify(ojObjJson));
}

function gatherData()
{
    ojGetPageTitle();
    ojGetBrowser();
    ojGetDevice();
    ojGetOs();
    ojGetRef();
}

let ojLink = document.querySelectorAll('a');
for(let ojelem of ojLink){
    ojelem.addEventListener('click',()=>{
        sendReport();
    });
}
