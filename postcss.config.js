module.exports = ({ env }) => ({
    plugins: [
        require('autoprefixer'),
        require('cssnano'),
        require("postcss-inline-svg"),
        require("postcss-import")
    ]
})