/**
 * The internal dependencies.
 */
const utils = require('./lib/utils');

/**
 * Setup PostCSS plugins.
 */
const plugins = [
  require('tailwindcss')(utils.srcPath('build/tailwindcss.js')),
  require('postcss-discard-comments'),
  require('autoprefixer'),

  // please read about below lib: https://www.npmjs.com/package/postcss-combine-media-query
  // require('./lib/combine-media-queries'),
];

/**
 * Prepare the configuration.
 */
const config = {
  plugins,
};

module.exports = config;
