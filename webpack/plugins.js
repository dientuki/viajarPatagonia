const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const WebpackAssetsManifest = require('webpack-assets-manifest');
const paths = require("./paths");
const plugins = [];

plugins.push(
    new CleanWebpackPlugin()
);

plugins.push(new MiniCssExtractPlugin({
    filename:'[name]-[contenthash].css'
}));

plugins.push(new WebpackAssetsManifest());

module.exports = plugins;