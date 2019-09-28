const optimization = {};
const minimizer = [];
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");

optimization['splitChunks'] = {
    chunks: 'all',
    cacheGroups: {
      default: false,
      vendors: false,
    }
  };

  if (process.env.NODE_ENV == 'production') {
    optimization['minimize'] = true;
    
    minimizer.push(new OptimizeCSSAssetsPlugin({}));
    
    optimization['minimizer'] = minimizer;

  }

module.exports = optimization;
/*
    minimizer: [
      new UglifyJsPlugin({
        sourceMap: false,
        uglifyOptions: {
          output: {beautify: false},
          compress: {
            unused: true,
            dead_code: true,
            warnings: false
          },
          mangle: true
        }
      }),
      new OptimizeCSSAssetsPlugin({})
    ]
  }
  */