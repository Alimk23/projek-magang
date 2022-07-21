const PhoneFormatter = ({ props }) => {
    var check1 = props.startsWith(0);
    var check2 = props.startsWith(62);
    if (check1) {
        return "62" + props.substring(1);
    } else if (check2) {
        return "0" + props.substring(2);
    } else {
        return null;
    }
};

export default PhoneFormatter;
