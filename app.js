var express = require('express');
var http = require('http');
var path = require('path');
var bodyParser= require('body-parser');
var mongoose = require('mongoose');

var app = express();

// link css and jss folder
app.use(express.static(__dirname + '/public'));

// suppoert json data and body data
app.use(bodyParser.urlencoded({extended: true}));
app.use(bodyParser.json());


//database connection
var dbURI = 'mongodb://localhost/newcrud';
// Create the database connection 
mongoose.connect(dbURI);
mongoose.connection.on('connected', function () {  
  console.log('Mongoose default connection open to  ' + dbURI);
}); 
mongoose.connection.on('error',function (err) {  
  console.log('Mongoose default connection error: ' + dbURI);
}); 
mongoose.connection.on('disconnected', function () {  
  console.log('Mongoose default connection disconnected' + dbURI); 
});

// database schema
var Schema = mongoose.Schema;
var userSchema = new Schema({
  first : String ,
  last: String,
  age: Number,
  gender: String,
  hobby: Object , 
  branch: String ,
  img: String
});
var emp = mongoose.model('emp', userSchema);

// create server
app.listen(3000, function() {
  console.log('listening on 3000')
})

app.get('/', function (req, res) {
 res.sendFile(__dirname + '/index.html');
})

app.get('/emps/', function (req, res) {
  emp.find({}, function (err, docs) {
        res.json(docs);		
    });
})


app.delete('/delete/:id', function (req, res) {
	var delID = req.param('id');
	var query = emp.remove({ _id: delID });
	query.exec();
	res.send({"ok":1});
});

app.post('/addemps', function (req, res){
	var payload = new emp({
		"branch": req.body.branch,
		"first": req.body.first,
		"last": req.body.last,
		"age": req.body.age,
		"gender": req.body.gender,
		"hobby": req.body.hobby
	})
	 payload.save(function(err) {
	  if (err) throw err;
	  res.send(payload); 
	}); 
})

app.put('/updateinfo/:id', function (req, res) {

	console.log(req.body.hobby);
	
	emp.findOneAndUpdate({_id: req.body._id}, {$set:{
		branch: req.body.branch,
		first: req.body.first,
		last: req.body.last,
		age: req.body.age,
		gender: req.body.gender,
		hobby: req.body.hobby
	}}, {new: true}, function(err, doc){
		if(err){
			console.log("Something wrong when updating data!");
		}
		res.send(doc);
	});
	
});

