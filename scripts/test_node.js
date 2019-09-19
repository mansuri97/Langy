var sys = require("sys");
var my_http = require("http");
var url = require("url")

var express = require("express");
var app = express();

my_http.createServer(function (request, response) {
    var my_path = url.parse(request.url).pathname;
    if (my_path === "/test_url") {
        sys.puts("I got kicked");
        response.writeHeader(200, { "Content-Type": "text/plain" });
        response.write("It's working!!");
        response.end();
    } else {
        sys.puts("I got kicked");
        response.writeHeader(200, { "Content-Type": "text/plain" });
        response.write("Hello World");
        response.end();
    }
}).listen(8080);
sys.puts("Server Running on 8080");