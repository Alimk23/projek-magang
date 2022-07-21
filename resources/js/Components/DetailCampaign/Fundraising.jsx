import { useRef, useEffect } from "react";

const isNominal = (props) => {
    return props.map((data, i) => {
        if (data.donation.status == 1) {
            return data.donation.nominal;
        } else {
            return 0;
        }
    });
};

const isFundraising = (props) => {
    return props.map((dataArray) => {
        const nominal = isNominal(dataArray.donation_by_fundraiser);
        let sum = 0;
        for (let i = 0; i < nominal.length; i++) {
            sum += nominal[i];
        }

        const status = nominal.filter(function (x) {
            return x !== 0;
        });

        const currency = new Intl.NumberFormat("id-ID");

        return dataArray.user.map((user, i) => {
            return (
                <div key={i}>
                    <div className="flex flex-row items-start">
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
                        <div className="flex flex-col mx-3">
                            <div className="font-bold">{user.name}</div>
                            <p className="">
                                Telah berhasil mengajak{" "}
                                <strong>{status.length}</strong> orang untuk
                                bersedekah sebanyak:{" "}
                                <strong>Rp {currency.format(sum)}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            );
        });
    });
};

const noFundraising = () => {
    return <div>Belum ada fundraiser</div>;
};

const Fundraising = ({ fundraising }) => {
    return fundraising.length == 0
        ? noFundraising()
        : isFundraising(fundraising);
};

export default Fundraising;
