const {mix} = require("laravel-mix");
mix.setPublicPath("assets/default");
mix.setResourceRoot("../");
mix.webpackConfig({
  module: {
    rules: [
      {
        test: /\.css$/,
        loader: "style-loader!css-loader"
      }
    ]
  }
});

mix
  //.js("./assets/js/vue_app.js", "./assets/js/vue_app_packed.js")
  .babel(
    [
        './node-modules/jquery/dist/jquery.js',
        './node-modules/popper.js/dist/popper.js',
        './node-modules/bootstrap/dist/js/bootstrap.js',
        './src/js/ws-ci-app.js'
    ],
    "./assets/default/js/ws-ci-app.js"
  )
  .sass("./src/scss/ws-ci-app.scss", "./css/ws-ci-app.css");
