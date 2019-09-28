const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const WebpackAssetsManifest = require('webpack-assets-manifest');
const StyleLintPlugin = require('stylelint-webpack-plugin');
const paths = require("./paths");
const plugins = [];

plugins.push(
    new CleanWebpackPlugin()
);

if (process.env.NODE_ENV == 'development') {
  plugins.push(
    new StyleLintPlugin({
        configFile : "stylelint.json",
        sintax : 'scss',
        files : 'resources/sass/**/*.scss',
      }),
  );
}

plugins.push(new MiniCssExtractPlugin({
    filename:'[name]-[contenthash].css'
}));

plugins.push(new WebpackAssetsManifest());

module.exports = plugins;