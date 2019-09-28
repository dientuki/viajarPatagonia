// Native Node modules.
const path = require("path");

const baseDir = path.resolve(__dirname, "..");

module.exports = {
    base: baseDir,
    dist: path.resolve(baseDir, "public", "dist"),
    publicPath: '../public/dist'
}