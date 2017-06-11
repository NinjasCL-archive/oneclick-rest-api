// Test the OneClick Api Endpoints
// Requires npm, mocha, chai, chai-http
// run: npm test

// Main Configuration
var server = 'http://oneclick-rest-api.dev/api';
var finishUrl = server + '/registration/finish.php';
var authToken = '_CHANGE_ME_WITH_A_GUID_';

var verbose  = false;

var chai = require('chai');
var chaiHttp = require('chai-http');
var should = chai.should();
chai.use(chaiHttp);

function fuser()
{

  var id = Math.floor((Math.random() * 100000000000) + 1);
  var user = new Object();

  user.name = 'user-' + id;
  user.email = 'user-' + id + '@test.dev';
  
  return user;
}

function log(obj)
{
  if(verbose)
  {
    console.log(JSON.stringify(obj));
  }
}

function error(obj)
{
  if(verbose)
  {
    console.error(JSON.stringify(obj));
  }
}


// Init Tests

describe('Unauthorized Calls', function()
{
  
  describe('Unauthorized init.php', function()
  {

    it('Unathorized /registration/init.php should fail GET', function(done)
    {
      chai.request(server)
        .get('/registration/init.php')
        .set('x-auth-token', '')
        .set('x-tbk-token', '')
        .query(
          {
            user: 'user1',
            email: 'user@test.dev',
            url: 'fake:url'
          })
        .end(function(err, res)
        {

          error(err);
          log(res);

          res.should.have.status(401);
          res.should.be.json;
          res.body.should.be.a('object');
          
          res.body.should.have.property('error')
          res.body.error.should.be.a('object')
          res.body.error.should.have.property('message')
          res.body.error.message.should.be.a('string')
          
          res.body.should.have.property('_meta')
          res.body._meta.should.be.a('object')

          res.body.should.have.property('status')
          res.body.status.should.be.a('number')
          res.body.status.should.equal(401)

          done();
        });
    });
  });

  describe('Unauthorized finish.php', function()
  {

    it('Unathorized /registration/finish.php should fail GET', function(done)
    {
      chai.request(server)
        .get('/registration/finish.php')
        .set('x-auth-token', '')
        .set('x-tbk-token', '')
        .query(
          {
            session: 'abc123',
          })
        .end(function(err, res)
        {

          error(err);
          log(res);

          res.should.have.status(401);
          res.should.be.json;
          res.body.should.be.a('object');
          
          res.body.should.have.property('error')
          res.body.error.should.be.a('object')
          res.body.error.should.have.property('message')
          res.body.error.message.should.be.a('string')
          
          res.body.should.have.property('_meta')
          res.body._meta.should.be.a('object')

          res.body.should.have.property('status')
          res.body.status.should.be.a('number')
          res.body.status.should.equal(401)

          done();
        });
    });
  });

  describe('Unauthorized remove.php', function()
  {

    it('Unathorized /registration/remove.php should fail GET', function(done)
    {
      chai.request(server)
        .get('/registration/remove.php')
        .set('x-auth-token', '')
        .set('x-tbk-token', '')
        .query(
          {
            user: 'user1',
          })
        .end(function(err, res)
        {

          error(err);
          log(res);

          res.should.have.status(401);
          res.should.be.json;
          res.body.should.be.a('object');
          
          res.body.should.have.property('error')
          res.body.error.should.be.a('object')
          res.body.error.should.have.property('message')
          res.body.error.message.should.be.a('string')
          
          res.body.should.have.property('_meta')
          res.body._meta.should.be.a('object')

          res.body.should.have.property('status')
          res.body.status.should.be.a('number')
          res.body.status.should.equal(401)

          done();
        });
    });
  });

  describe('Unauthorized authorize.php', function()
  {

    it('Unathorized /payments/authorize.php should fail GET', function(done)
    {
      chai.request(server)
        .get('/payments/authorize.php')
        .set('x-auth-token', '')
        .set('x-tbk-token', '')
        .query(
          {
            user: 'user1',
            order: '12356',
            amount: '50000'
          })
        .end(function(err, res)
        {

          error(err);
          log(res);

          res.should.have.status(401);
          res.should.be.json;
          res.body.should.be.a('object');
          
          res.body.should.have.property('error')
          res.body.error.should.be.a('object')
          res.body.error.should.have.property('message')
          res.body.error.message.should.be.a('string')
          
          res.body.should.have.property('_meta')
          res.body._meta.should.be.a('object')

          res.body.should.have.property('status')
          res.body.status.should.be.a('number')
          res.body.status.should.equal(401)

          done();
        });
    });
  });

  describe('Unauthorized reverse.php', function()
  {

    it('Unathorized /payments/reverse.php should fail GET', function(done)
    {
      chai.request(server)
        .get('/payments/reverse.php')
        .set('x-auth-token', '')
        .set('x-tbk-token', '')
        .query(
          {
            order: '12345'
          })
        .end(function(err, res)
        {

          error(err);
          log(res);

          res.should.have.status(401);
          res.should.be.json;
          res.body.should.be.a('object');
          
          res.body.should.have.property('error')
          res.body.error.should.be.a('object')
          res.body.error.should.have.property('message')
          res.body.error.message.should.be.a('string')
          
          res.body.should.have.property('_meta')
          res.body._meta.should.be.a('object')

          res.body.should.have.property('status')
          res.body.status.should.be.a('number')
          res.body.status.should.equal(401)

          done();
        });
    });
  });
});

describe('Wrong Params Calls', function()
{
  
  describe('Wrong Params init.php', function()
  {
    it('Should fail when wrong params are sent to /registration/init.php GET', function(done)
    {

      var user = fuser();

      chai.request(server)
        .get('/registration/init.php')
        .set('x-auth-token', authToken)
        .set('x-tbk-token', '')
        .query(
          {
            user: user.name,
            email: user.email,
            url: '' // url is missing
          })
        .end(function(err, res)
        {
          
          error(err);
          log(res);

          res.should.have.status(400);
          res.should.be.json;
          res.body.should.be.a('object');
          
          res.body.should.have.property('error');
          res.body.error.should.be.a('object');
          res.body.error.should.have.property('message')
          res.body.error.message.should.be.a('string')
          
          res.body.should.have.property('_meta')
          res.body._meta.should.be.a('object')

          res.body.should.have.property('status')
          res.body.status.should.be.a('number')
          res.body.status.should.equal(400)

          done();
        });
    });
  });

  describe('Wrong Params finish.php', function()
  {
    it('Should fail when wrong params are sent to /registration/finish.php GET', function(done)
    {

      var user = fuser();

      chai.request(server)
        .get('/registration/finish.php')
        .set('x-auth-token', authToken)
        .set('x-tbk-token', '')
        .query(
          {
            session: '' // session is missing
          })
        .end(function(err, res)
        {
          
          error(err);
          log(res);

          res.should.have.status(400);
          res.should.be.json;
          res.body.should.be.a('object');
          
          res.body.should.have.property('error');
          res.body.error.should.be.a('object');
          res.body.error.should.have.property('message')
          res.body.error.message.should.be.a('string')
          
          res.body.should.have.property('_meta')
          res.body._meta.should.be.a('object')

          res.body.should.have.property('status')
          res.body.status.should.be.a('number')
          res.body.status.should.equal(400)

          done();
        });
    });
  });

  describe('Wrong Params remove.php', function()
  {
    it('Should fail when wrong params are sent to /registration/remove.php GET', function(done)
    {

      var user = fuser();

      chai.request(server)
        .get('/registration/remove.php')
        .set('x-auth-token', authToken)
        .set('x-tbk-token', '')
        .query(
          {
            user: '' // user is missing
          })
        .end(function(err, res)
        {
          
          error(err);
          log(res);

          res.should.have.status(400);
          res.should.be.json;
          res.body.should.be.a('object');
          
          res.body.should.have.property('error');
          res.body.error.should.be.a('object');
          res.body.error.should.have.property('message')
          res.body.error.message.should.be.a('string')
          
          res.body.should.have.property('_meta')
          res.body._meta.should.be.a('object')

          res.body.should.have.property('status')
          res.body.status.should.be.a('number')
          res.body.status.should.equal(400)

          done();
        });
    });
  });

  describe('Wrong Params authorize.php', function()
  {
    it('Should fail when wrong params are sent to /payments/authorize.php GET', function(done)
    {

      var user = fuser();

      chai.request(server)
        .get('/payments/authorize.php')
        .set('x-auth-token', authToken)
        .set('x-tbk-token', '')
        .query(
          {
            user: '', // user is missing
            order: 14242123,
            amount: 100000
          })
        .end(function(err, res)
        {
          
          error(err);
          log(res);

          res.should.have.status(400);
          res.should.be.json;
          res.body.should.be.a('object');
          
          res.body.should.have.property('error');
          res.body.error.should.be.a('object');
          res.body.error.should.have.property('message')
          res.body.error.message.should.be.a('string')
          
          res.body.should.have.property('_meta')
          res.body._meta.should.be.a('object')

          res.body.should.have.property('status')
          res.body.status.should.be.a('number')
          res.body.status.should.equal(400)

          done();
        });
    });
  });

  describe('Wrong Params reverse.php', function()
  {
    it('Should fail when wrong params are sent to /payments/reverse.php GET', function(done)
    {

      var user = fuser();

      chai.request(server)
        .get('/payments/reverse.php')
        .set('x-auth-token', authToken)
        .set('x-tbk-token', '')
        .query(
          {
            order: '' // order is missing
          })
        .end(function(err, res)
        {
          
          error(err);
          log(res);

          res.should.have.status(400);
          res.should.be.json;
          res.body.should.be.a('object');
          
          res.body.should.have.property('error');
          res.body.error.should.be.a('object');
          res.body.error.should.have.property('message')
          res.body.error.message.should.be.a('string')
          
          res.body.should.have.property('_meta')
          res.body._meta.should.be.a('object')

          res.body.should.have.property('status')
          res.body.status.should.be.a('number')
          res.body.status.should.equal(400)

          done();
        });
    });
  });

});

describe('Transbank Calls', function()
{
  
  describe('Request init.php', function()
  {

    it('Request to /registration/init.php should bring data GET', function(done)
    {
      
      var user = fuser();

      chai.request(server)
        .get('/registration/init.php')
        .set('x-auth-token', authToken)
        .set('x-tbk-token', '')
        .query(
          {
            user: user.name,
            email: user.email,
            url: finishUrl
          })
        .end(function(err, res)
        {

          error(err);
          log(res);

          res.should.have.status(200);
          res.should.be.json;
          res.body.should.be.a('object');
          
          res.body.should.have.property('data')
          res.body.data.should.be.a('object')

          res.body.data.should.have.property('session')
          res.body.data.session.should.be.a('string')

          res.body.data.should.have.property('url')
          res.body.data.url.should.be.a('string')

          res.body.should.have.property('_meta')
          res.body._meta.should.be.a('object')

          res.body.should.have.property('status')
          res.body.status.should.be.a('number')
          res.body.status.should.equal(200)

          done();
        });
    });
  });
});
