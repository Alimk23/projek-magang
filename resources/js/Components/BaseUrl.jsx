import axios from "axios";
const BaseUrl = () => {
    return (axios.defaults.baseURL = "http://hobisedekah.test");
};

export default BaseUrl;
