const path = require('path');

// Import the required modules

// Get the current directory
const currentDirectory = __dirname;

// Get the current file name
const currentFile = __filename;

// Log the current directory and file name
console.log('Current Directory:', currentDirectory);
console.log('Current File:', currentFile);

// Check if 'EcoRide' is in the current directory or file name
const searchString = 'EcoRide';
const isInDirectory = currentDirectory.includes(searchString);
const isInFile = currentFile.includes(searchString);

console.log(`Is "${searchString}" in the current directory?`, isInDirectory);
console.log(`Is "${searchString}" in the current file name?`, isInFile);

// Join paths
const newPath = path.join(currentDirectory, 'newFolder', 'newFile.txt');
console.log('New Path:', newPath);




