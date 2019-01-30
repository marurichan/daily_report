var path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
  devtool: 'inline-source-map',
  entry: {
    custom: './resources/assets/css/custom.css',
    admin: './resources/assets/css/admin.css',
  },
  output: {
    path: path.join(__dirname, 'public/css'),
    filename: '[name].css'
  },
  module: {
    rules: [
      {
        test: /\.css$/,
        use: ExtractTextPlugin.extract({
          fallback: "style-loader",
          use: "css-loader?minimize"
        })
      },
    ]
  },
   plugins: [
    new ExtractTextPlugin({
      filename: '[name].css'
    })
   ]
}

