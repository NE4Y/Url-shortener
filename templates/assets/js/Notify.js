/**
 * Created by Steffen on 18.06.16.
 */

function Notify(msg) {
    this.message = msg;
}

Notify.prototype = {
    constructor: Notify,
    showNotification: function() {
        var sec = document.createElement("section");
        sec.setAttribute("id", "notifyBox");
        var tNode = document.createTextNode(this.message);

        sec.appendChild(tNode);

        document.body.appendChild(sec);

        setTimeout(function() { document.getElementById("notifyBox").remove()}, 2000);
    }
}


