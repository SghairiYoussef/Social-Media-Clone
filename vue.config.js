const { defineConfig } = require('@vue/cli-service')

module.exports = defineConfig({
  transpileDependencies: true,
  chainWebpack: config => {
    // Add a loader for PHP files
    config.module
      .rule('php')
      .test(/\.php$/)
      .use('raw-loader')
      .loader('raw-loader')
      .end()
  }
})
