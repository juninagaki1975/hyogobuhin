import os,sys
from flask import Flask, redirect, request
from flask import render_template
from flask_sqlalchemy import SQLAlchemy
from flask_login import UserMixin, LoginManager, login_user, logout_user, login_required, current_user
from werkzeug.security import generate_password_hash, check_password_hash
from flask_bootstrap import Bootstrap

from datetime import datetime
import pytz

app = Flask(__name__)
app.__static__folder = os.getcwd() + 'static'               
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///blog.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config['SECRET_KEY'] = os.urandom(24)
db = SQLAlchemy(app)
bootstrap = Bootstrap(app)

login_manager = LoginManager()
login_manager.init_app(app)
login_manager.login_view = "login"

class Post(db.Model):
    id = db.Column(db.Integer, primary_key=True)
#    id = db.Column(db.Integer, Sequence('id_seq'), primary_key=True)
    title = db.Column(db.String(80), nullable=False)
    body = db.Column(db.String(300), nullable=False)
    created_at = db.Column(db.DateTime, nullable=False,
            default = datetime.now(pytz.timezone('Asia/Tokyo')))

class User(UserMixin, db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(30), nullable=False, unique=True)
    password = db.Column(db.String(12), nullable=False)

@login_manager.user_loader
def load_user(user_id):
    return User.query.get(int(user_id))

@app.route('/mainbody', methods=['GET','POST'])
@login_required
def index():
    if request.method == 'GET':
        posts = Post.query.all()
        return render_template('index.html', posts=posts)
    else:
        return redirect('/')

@app.route('/signup', methods=['GET', 'POST'])
def signup():
    message = "ー"
    if request.method == 'POST':
        username = request.form.get('username')
        password = request.form.get('password')


        users = User.query.all()
        check_name = []
        for i in range(len(users)):
            check_name.append(users[i].__dict__["username"])

        if username in check_name:
            print("既に使用されている名前です。")
            message = ("既に使用されている名前です："+username)
            return render_template('signup.html', message = message)
        else:

            user = User(username=username, password=generate_password_hash(password, method='sha256'))

            db.session.add(user)
            db.session.commit()
            return redirect('/')
    else:
        return render_template('signup.html', message=message)

@app.route('/', methods=['GET', 'POST'])
def login():
    if  current_user.is_authenticated:
        return redirect('/')
    if request.method == 'POST':
        username = request.form.get('username')
        password = request.form.get('password')

        user = User.query.filter_by(username=username).first()
        if check_password_hash(user.password, password):
            login_user(user)
            return redirect('/mainbody')
    else:
        return render_template('login.html')

@app.route('/logout')
@login_required
def logout():
    logout_user()
    return redirect('/')

@app.route('/create', methods=['GET', 'POST'])
@login_required
def create():
    if request.method == 'POST':
        title = request.form.get('title')
        body = request.form.get('body')

        post = Post(title=title, body=body)

        db.session.add(post)
        db.session.commit()
        return redirect('/mainbody')
    else:
        return render_template('create.html')

@app.route('/<int:id>/update', methods=['GET', 'POST'])
@login_required
def update(id):
    post = Post.query.get(id)
    if request.method == 'GET':

        return render_template('update.html', post=post)
    else:
        post.title = request.form.get('title')
        post.body = request.form.get('body')
        db.session.commit()

        return redirect('/mainbody')

@app.route('/<int:id>/delete', methods=['GET'])
@login_required
def delete(id):
    post = Post.query.all(id)
    db.session.delete(post)
    db.session.commit()

    return redirect('/mainbody')

#Jun 2022.6.8
@app.route('/users', methods=['GET'])
@login_required
def users():
    users = User.query.all()
    for i in range(len(users)):
        tmp = users[i].__dict__["username"]
        print(tmp)
        
    return render_template('users.html',users=users)
#end

#Jun 2022.6.8
@app.route('/user_name', methods=['GET'])
@login_required
def user_name(username):
    user_name = User.query.get(username)
    return render_template('users.html',user_name=user_name)
#end


#@app.errorhandler(Exception)
#def exception_handler(e):
#    return "handling exception"

if __name__=="__main__":
    app.run(Debug=False)

    lits_db = db.query()