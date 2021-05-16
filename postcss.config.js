module.exports = ({ env }) => ({
    plugins: [
        require('autoprefixer'),
        require('cssnano')({
            preset: 'default',
        }),
        require("postcss-inline-svg"),
        require("postcss-import")
    ]
})