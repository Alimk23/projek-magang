import { Link } from "@inertiajs/inertia-react";
import { useRef, useEffect } from "react";

const isCampaign = (campaign) => {
    return campaign.map((data, i) => {
        const collected = data.collected;
        const target = data.target;

        const dateNow = new Date();
        const endDate = new Date(data.end_date);
        const differentTime = endDate.getTime() - dateNow.getTime();
        const differentDay = differentTime / (1000 * 3600 * 24);

        const donationBtn = useRef(null);
        useEffect(() => {
            if (parseInt(differentDay) < 0) {
                donationBtn.current.classList.remove("btn-primary");
            }
        }, []);

        const currency = new Intl.NumberFormat("id-ID");

        return (
            <div key={i} className="card w-96 bg-base-100 shadow-xl">
                <Link href={"/detail/campaign/" + data.slug}>
                    <figure>
                        <img
                            src={"/storage/" + data.cover}
                            alt="Campaign"
                            className="w-96 h-64"
                        />
                    </figure>
                </Link>
                <div className="card-body">
                    <Link href={"/detail/campaign/" + data.slug}>
                        <h2 className="card-title font-bold">{data.title}</h2>
                    </Link>
                    <div className="text-sm flex flex-row items-center gap-2">
                        {data.user.company.company_name}
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            className="h-6 w-6 text-primary"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            strokeWidth={2}
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"
                            />
                        </svg>
                    </div>
                    <p>{data.caption}</p>
                    <progress
                        className="progress progress-primary w-full"
                        value={(collected / target) * 100}
                        max="100"
                    ></progress>
                    <div className="flex flex-row justify-between">
                        <div className="flex flex-col">
                            <div className="text-xl font-bold">
                                Rp {currency.format(data.collected)}
                            </div>
                            <div>Donasi Terkumpul</div>
                        </div>
                        <div className="flex flex-col">
                            <div className="text-xl font-bold">
                                {parseInt(differentDay) < 0
                                    ? "Sudah Berakhir"
                                    : parseInt(differentDay)}
                            </div>
                            <div>
                                {parseInt(differentDay) < 0 ? "" : "Hari Lagi"}
                            </div>
                        </div>
                    </div>
                    <div className="flex flex-col gap-2"></div>
                    <div className="card-actions justify-end">
                        <button ref={donationBtn} className="btn btn-primary">
                            <Link href={"/detail/campaign/" + data.slug}>
                                Donasi Sekarang
                            </Link>
                        </button>
                    </div>
                </div>
            </div>
        );
    });
};

const noCampaign = () => {
    return <div>Belum ada campaign yang tersedia</div>;
};

const CampaignList = (props) => {
    return !props.campaign ? noCampaign() : isCampaign(props.campaign);
};

export default CampaignList;
