const Ajax = function () {
    let XMLHttpResource;
    let sendingNow = false;
    let requestCallback;

    const catchRequestAnswer = () => {
        if (XMLHttpResource.readyState === XMLHttpRequest.DONE) {
            sendingNow = false;
            if (XMLHttpResource.status === 0 || (200 >= XMLHttpResource.status && XMLHttpResource.status < 400)) {
                requestCallback(XMLHttpResource.responseText);
            }
        }
    };

    this.request = (url, method, callback) => {
        if (sendingNow) {
            return;
        }
        sendingNow = true;
        requestCallback = callback;
        XMLHttpResource = new XMLHttpRequest();
        XMLHttpResource.open(method, url, true);
        XMLHttpResource.onreadystatechange = catchRequestAnswer;
        XMLHttpResource.send();
    }
}
