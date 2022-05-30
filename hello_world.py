from flask import Flask
from markupsafe import escape

app = Flask(__name__)

@app.route("/japan")
def japan():
    return "Hello, Japan!"

@app.route("/america")
def america():
    return "Hello, America!"

@app.route("/world")
def hello_world():
    return "Hello, World!"
