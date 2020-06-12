module.exports = ({ env }) => ({
    plugins: [
        require('autoprefixer'),
        require('cssnano'),
        require("postcss-import")
    ]
})