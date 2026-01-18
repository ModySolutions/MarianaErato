const path = require( 'path' );
const defaults = require( '@wordpress/scripts/config/webpack.config.js' );

module.exports = () => ( {
	...defaults,
	entry: {
		app: path.resolve( process.cwd(), 'themes/marianaerato/src/scripts', 'app.js' ),
	},
	output: {
		filename: '[name].js',
		path: path.resolve( process.cwd(), 'themes/marianaerato/dist' ),
	},
	module: {
		...defaults.module,
		rules: [
			...defaults.module.rules,
			{
				test: /\.(png|svg|jpg|jpeg|gif)$/i,
				type: 'asset/resource',
			}
		],
	},
} );
