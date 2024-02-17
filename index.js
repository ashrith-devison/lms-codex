const express = require('express');
const { exec } = require('child_process');
const multer = require('multer');
const app = express();
const path = require('path');

app.use(express.urlencoded({extended: false}));
app.use(express.json());
app.all("/", (req, res) => {
    res.sendFile("C:/wamp64/www/vit-lms-2.0/index.html");
});

app.all("/lms/content", (req, res) => {
    const command = '"C:/wamp64/bin/php/php8.2.13/php.exe" -f '+ "C:/wamp64/www/vit-lms-2.0/home.php";
    exec(command, (error, stdout, stderr) => {
        if (error) {
            console.error(`Error executing PHP file: ${error}`);
            return res.status(500).send('Internal Server Error');
        }
        res.send(stdout);
    });
});

app.all("/lms/content/:id",(req,res) => {
    console.log("Welcome");
    const url = decodeURIComponent(req.params.id);
    console.log(url);
    const command = '"C:/wamp64/bin/php/php8.2.13/php.exe" -f '+url;
    console.log(command);
    exec(command, (error, stdout, stderr) => {
        if (error) {
            console.error(`Error executing PHP file: ${error}`);
            return res.status(500).send('Internal Server Error');
        }
        res.send(stdout);
    });
});

app.all("/lms/html/:id", (req, res) => {
    const url = decodeURIComponent(req.params.id);
    res.sendFile(url);
});

app.post("/course-site", (req, res) => {
    console.log("Received request:", {
        method: req.method,
        url: req.url,
        headers: req.headers,
        body: req.body,
    });

    const subject = req.body.coursename;
    console.log(req.body);
    const command = '"C:/wamp64/bin/php/php8.2.13/php.exe" -f C:/wamp64/www/vit-lms-2.0/course-mgnt/course_site.php '+subject;
    console.log(command);
    exec(command, (error, stdout, stderr) => {
        if (error) {
            console.error(`Error executing PHP file: ${error}`);
            return res.status(500).send('Internal Server Error');
        }
        res.send(stdout);
    });
}); 

app.all("/file-serve/:subject/:file",(req, res) => {
    var root = "C:/wamp64/www/vit-lms-2.0/university_files/";
    const subject = req.params.subject;
    const file = req.params.file;
    root = root + subject +'/' + file;
    console.log(root);
    res.sendFile(root);
});

app.all("/file-delete/:id",(req, res) => {
    const fileid = req.params.id;
    const command = '"C:/wamp64/bin/php/php8.2.13/php.exe" -f "C:/wamp64/www/vit-lms-2.0/course-mgnt/delete_file.php" '+ fileid;
    console.log(command);

    exec(command, (error,stdout, stderr) => {
        if(error){
            console.log(`error found : ${error}`);
            return res.status(500).send('Server Error');
        }
        res.send(stdout);
    });  
});
const storage = multer.diskStorage({
    destination: function (req, file, cb) {
        const course = req.body.coursename;
        console.log(course);
        return cb(null, './university_files/'+course);
    },
    filename: function (req, file, cb) {
        const fname = path.basename(file.originalname,path.extname(file.originalname)).replace(/ /g, '-');;
        return cb(null, `${fname}-(${Date.now()})${path.extname(file.originalname)}`);
    },
});

const upload = multer({ storage: storage });

app.all("/upload-file", upload.single('pdffile'), (req, res) => {
    console.log(req.body.coursename);
    console.log(req.file);
    const command = '"C:/wamp64/bin/php/php8.2.13/php.exe" -f "C:/wamp64/www/vit-lms-2.0/course-mgnt/upload_course_file_back.php" '+ req.body.coursename +' ' +req.file.filename;
    console.log(command);
    exec(command, (error, stdout, stderr) => {
        if (error) {
            console.error(`Error executing PHP file: ${error}`);
            return res.status(500).send('Internal Server Error');
        }
        res.send(stdout);
    });
});


app.listen(3000, ()=> {
    console.log("Server started");
});
