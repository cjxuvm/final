var express =require("express");

server=express();

server.use(express.static("test"));

server.get("/portfolio",function(req,res){

})

server.listen(8080,function(){
    console.log("Server is running at port 8080!");
})