# app.py

from flask import Flask, request, jsonify, render_template, redirect
import os
import json
import pusher
from datetime import datetime

app = Flask(__name__)


@app.route('/')
# def index():
#     return render_template('app.html')

@app.route('/capture', methods=['GET', 'POST'])

def parse_request():
    return "your text is "+request.args.get("inputText")


# run Flask app
if __name__ == "__main__":
    app.run()
