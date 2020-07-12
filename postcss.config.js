module.exports = ({ env }) => ({
    plugins: [
        require('autoprefixer'),
        require('postcss-clean')({
            level: 2
        }),
        require("postcss-inline-svg"),
        require("postcss-import")
    ]
})