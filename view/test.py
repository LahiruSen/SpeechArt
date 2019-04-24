# #!C:\Users\HP\PycharmProjects\CorseEraNLP\venv\Scripts\python.exe
# print("Content-Type: text/html\n")
# print("Hello Python Web Browser!! This is cool!!")

# from flask import Flask, render_template, request
#
# app = Flask(__name__)
#
# @app.route('/')
#
# def index():
#     return render_template("app.php")
#
# @app.route('/', methods=['POST'])
# def getValue():
#     text = request.form['text']
#     print (text)
#     return render_template('pass.html', text=text)
#
#
# if __name__ == '__main__':
#     app.run()

#!/usr/bin/env python

import sys

# def():
#     return ('Number of arguments:', len(sys.argv), 'arguments.')
# print ('Argument List:', str(sys.argv))


print(len(sys.argv))
