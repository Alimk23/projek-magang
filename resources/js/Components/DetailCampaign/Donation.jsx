import { useRef, useEffect } from "react";

const isDonation = (props) => {
    return props.map((data, i) => {
        const messageDonation = useRef(null);
        useEffect(() => {
            if (data.message && data.status == 1) {
                messageDonation.current.classList.remove("hidden");
            }
        }, []);

        const dateNow = new Date();
        const createdDate = new Date(data.updated_at);
        const differentTime = dateNow.getTime() - createdDate.getTime();
        const differentDay = differentTime / (1000 * 3600 * 24);

        const currency = new Intl.NumberFormat("id-ID");

        if (data.status == 1) {
            return (
                <div key={i}>
                    <div className="flex flex-row items-start my-5">
                        <div className="avatar">
                            <div className="w-10 h-10 rounded-full">
                                <img
                                    src="/img/default.png"
                                    alt="Akun"
                                    width="100px"
                                    className=""
                                />
                            </div>
                        </div>
                        <div className="flex flex-col w-full">
                            <div className="flex flex-row justify-between w-full">
                                <div className="flex flex-col mx-3">
                                    <div className="font-bold">
                                        {data.user.name}
                                    </div>
                                    <p className="">
                                        {parseInt(differentDay) +
                                            " hari yang lalu"}
                                    </p>
                                </div>
                                <div className="font-bold">
                                    {"Rp " + currency.format(data.nominal)}
                                </div>
                            </div>
                            <p
                                ref={messageDonation}
                                className="hidden mx-3 p-3 bg-slate-100 w-full"
                            >
                                {data.message}
                            </p>
                        </div>
                    </div>
                </div>
            );
        } else {
            return <div key={i}></div>;
        }
    });
};

const noDonation = () => {
    return <div>Belum ada donatur yang tercatat</div>;
};

const Donation = ({ props }) => {
    return props.length == 0 ? noDonation() : isDonation(props);
};

export default Donation;
