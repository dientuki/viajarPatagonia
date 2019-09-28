const paths = require("./paths");
const rules = [];

const MiniCssExtractPlugin = require("mini-css-extract-plugin");

rules.push({
    test: /\.js$/,
    exclude: /(node_modules|dist|js)/,
    use: {
      loader: 'babel-loader',
      options: {
        presets: ['@babel/preset-env', { modules: false }],
        cacheDirectory: true
      }
    }
  });

rules.push({
    test: /\.scss$/,
    use: [
      MiniCssExtractPlugin.loader,
      {loader: 'css-loader', options: { importLoaders: 1 }},
      'postcss-loader',
      {loader: 'sass-loader', options: {precision: 2}}
    ],
  });

module.exports = rules;  