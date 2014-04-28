var hogan = require('hogan.js'),
	fs = require('fs'),
	templateDir = '../views/shared',
	compiledDir = '../../public/js/templates',
	metaTemplate = 'shared_template_file.mustache',
	templateJsFile = hogan.compile(fs.readFileSync(metaTemplate, 'utf8'));

compileTemplates(templateDir, 'common.js');

function compileTemplates(dir, compiledFile){
	var compiledTemplates = [],
		templateFiles = fs.readdirSync(dir),
		fileCount = templateFiles.length,
		filePath,
		fileName,
		template,
		compiled,
		stats;

	for (var i = 0; i < fileCount; ++i){
		fileName = templateFiles[i];
		currentFile = dir + '/' + fileName;
		console.log("Touched file: " + currentFile);
		stats = fs.statSync(currentFile);
		if (stats.isDirectory()){
			compileTemplates(currentFile, fileName + '.js');
		}
		else {
			template = fs.readFileSync(currentFile, 'utf8');
			template = removeByteOrderMark(template.trim());
			compiled = hogan.compile(template, {asString: true});
			compiledTemplates.push({
				name: stripExtension(fileName),
				body: compiled
			});
		}
	}
	var output = templateJsFile.render({templates: compiledTemplates});

	var outputFile = compiledDir + '/' + compiledFile;
	fs.writeFile(outputFile, output, function(err){
		if (err) {
			console.log(err);
		}
		else {
			console.log("Wrote file" + outputFile);
		}
	});
}

function stripExtension(file){
	var index = file.lastIndexOf('.');
	if (index >= 0){
		return file.substring(0, index);
	}
	return file;
}

// Remove utf-8 byte order mark, http://en.wikipedia.org/wiki/Byte_order_mark
function removeByteOrderMark(text) {
  if (text.charCodeAt(0) === 0xfeff) {
    return text.substring(1);
  }
  return text;
}

