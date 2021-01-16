export default async (url, option = {}) => {
    let response = await fetch(url, option);
    if (response.ok && response.status === 200) {
        if (response.headers.get('Content-Type').indexOf('/json') !== -1) {
            return response.json();
        } else if (response.headers.get('Content-Type').indexOf('image/') !== -1) {
            return response.blob();
        } else {
            return response.text();
        }
    }
}