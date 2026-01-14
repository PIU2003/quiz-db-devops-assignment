from http.server import HTTPServer, BaseHTTPRequestHandler
import os

HOST = "127.0.0.1"
PORT = 8080


class MyHTTPServer(BaseHTTPRequestHandler):
    def do_GET(self):
        if self.path == "/":
            filename = "index.html"
        else:
            filename = self.path[1:]

        if os.path.exists(filename):
            self.send_response(200)
            self.send_header("Content-type", "text/html")
            self.end_headers()
            with open(filename, "rb") as file:
                self.wfile.write(file.read())
        else:
            self.send_response(404)
            self.send_header("Content-type", "text/html")
            self.end_headers()
            self.wfile.write(b"<h1>404 - Page Not Found</h1>")


server = HTTPServer((HOST, PORT), MyHTTPServer)
print(f"Server running at http://{HOST}:{PORT}")
server.serve_forever()
