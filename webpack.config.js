// const webpack = require('webpack')
const BrowserSyncPlugin = require("browser-sync-webpack-plugin")
const AutoPrefixer = require("autoprefixer")
const MiniCssExtractPlugin = require("mini-css-extract-plugin")
const FixStyleOnlyEntriesPlugin = require("webpack-fix-style-only-entries")

//const HardSourceWebpackPlugin = require("hard-source-webpack-plugin")

// モード値を production に設定すると最適化された状態で、
// development に設定するとソースマップ有効でJSファイルが出力される
// NOTE: 環境設定ファイル (.env) で切り替える予定
const MODE = "development";
const enabledSourceMap = MODE === "development";

module.exports = {

	mode: MODE,

	entry: {
		"script": "./src/main.js",
		"app": "./assets/sass/app.scss",
		"editor": "./assets/sass/editor.scss"
	},

	devtool: "source-map",

	output: {
		path: `${__dirname}/assets`,
		filename: 'js/[name].js'
	},

	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules\/(?!(dom7|ssr-window|swiper)\/).*/,
				//exclude: /node_modules\/(?!(dom7|ssr-window)\/).*/,
				use: [
					{
						loader: "babel-loader",
//						loader: "babel-loader?cacheDirectory",
						options: {
							presets: [
								"@babel/preset-env",
							],
						},
					},
				],
			},
			{
				test: /\.(scss|css)$/,
				use: [
					MiniCssExtractPlugin.loader,
					{
						loader: "css-loader",
						options: {
							// NOTE: url は無視
							sourceMap: enabledSourceMap,
							url: false,
							/*
								NOTE:
								0 => no loaders (default);
								1 => postcss-loader;
								2 => postcss-loader, sass-loader
							*/
							importLoaders: 2,
						},
					},
					{
						loader: "postcss-loader",
						options: {
							sourceMap: enabledSourceMap,
							postcssOptions: {
								plugins: [
									["autoprefixer", { grid: false} ],
								],
							},
						},
					},
					{
						loader: "sass-loader",
						options: {
							sourceMap: enabledSourceMap,
						},
					},
//					{
//						loader: "import-glob-loader",
//					},
				],
			},
		],
	},

	plugins: [
		new BrowserSyncPlugin({
			host: "localhost",
			port: 3000,
			proxy: "knowledgecommons.test",
			files: [
				"./**/*.php",
				"./**/*.html",
				"./**/*.json",
				//"./assets/css/*.css",
				//"./assets/js/*.js",
			]
		}),
		new FixStyleOnlyEntriesPlugin(),
		new MiniCssExtractPlugin({
			filename: (pathData) => {

				// script エントリの CSS だけ common.css にする
				if (pathData.chunk.name === 'script') {
					return 'css/common.css';
				}
				return 'css/[name].css';

			},
		}),
		// new webpack.ProvidePlugin({
		// 	$: 'jquery',
		// }),
	],

	cache: {
		type: 'filesystem',
		buildDependencies: {
			config: [__filename]
		}
//		type: 'memory',
//		idleTimeout: 60000,
	},


	// NOTE: ES5 対策
	target: ["web", "es5"],

};