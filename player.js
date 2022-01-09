var log = function(message) {
    console.log(new Date().toLocaleString() + ": " + message);        
};

var show = function(object, state) {
    if(object == null) return;
    if(state && object.style.display == 'block') return;
    if(!state && object.style.display == 'none') return;
    object.style.display = state ? 'block' : 'none';
};

var isTest = function() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    return urlParams.has('test');
};

var isOpened = function() {
    const now = new Date();
    const nowMins = mins(now.getHours(), now.getMinutes());
    const openMins = mins(openHours, openMinutes);
    const closeMins = mins(closeHours, closeMinutes);

    return nowMins >= openMins && nowMins <= closeMins;
};

var mins = function(hours, minutes) {
    return hours * 60 + minutes;
};

var checkOpenHours = function() {
    if(isOpened()) {
        show(animation, true);
        log("Check open hours: Show AD.");
    } else {
        show(animation, false);
        log("Check open hours: Hide AD.");
    }
};

var checkLatest = function() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', img_url + "?t=" + (new Date()).getTime());
    xhr.send();
    xhr.onload = function() {
        if (xhr.status == 200) {
            var newmoddate = xhr.getResponseHeader('Last-Modified');
            if(lastmoddate == null) {
                log("Check latest: First load.");
                lastmoddate = newmoddate;
            } else if(newmoddate != lastmoddate) {
                log("Check latest: Animation is changed. Reloading.");
                location.reload();
            } else if(newmoddate == lastmoddate) {
                log("Check latest: Animation is not changed. Skipping.");
            }
            return;
        }
        log("Check latest: Error: (" + xhr.status + ")");
    };
    xhr.onerror = function() {
        log("Check latest: Error: (" + xhr.status + ")");
    };
};

var clearConsole = function() {
    console.clear();
};

const openHours = 7; const openMinutes = 0;
const closeHours = 18; const closeMinutes = 59;

log("Initializating...");
var img_url = "https://reklama-snehulak.cz/media/animation.gif";
var animation = document.getElementById('animation');
var lastmoddate = null;
animation.src = img_url + "?t=" + (new Date()).getTime();

checkOpenHours();
checkLatest();
// every 30 seconds hide or show ad
setInterval(checkOpenHours, 30000);
// every minute check if image is latest
setInterval(checkLatest, 60000);
// every 5 hours clear console
setInterval(clearConsole, 7200000);