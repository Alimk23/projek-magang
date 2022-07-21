import { React, ReactDOM, useRef, useEffect } from "react";
import { Head, Link } from "@inertiajs/inertia-react";
import Navbar from "@/Components/Navbar";
import Header from "@/Components/Header";
import Footer from "@/Components/Footer";
import BackButton from "@/Components/BackButton";
import Fundraising from "@/Components/DetailCampaign/Fundraising";
import Donation from "@/Components/DetailCampaign/Donation";
import News from "@/Components/DetailCampaign/News";

const createMarkup = (description) => {
    return { __html: description };
};

function formatPhoneNumber(phoneNumber) {
    var check1 = phoneNumber.startsWith(0);
    var check2 = phoneNumber.startsWith(62);
    if (check1) {
        return "62" + phoneNumber.substring(1);
    } else if (check2) {
        return "0" + phoneNumber.substring(2);
    } else {
        return null;
    }
}

export default function Campaign(props) {
    const collected = props.campaign.collected;
    const target = props.campaign.target;

    const dateNow = new Date();
    const endDate = new Date(props.campaign.end_date);
    const differentTime = endDate.getTime() - dateNow.getTime();
    const differentDay = differentTime / (1000 * 3600 * 24);

    const donationBtn = useRef(null);
    const desc = createMarkup(props.campaign.description);

    const phoneNumber = formatPhoneNumber(props.campaign.cs.phone);
    const backBtn = () => {};
    useEffect(() => {
        if (parseInt(differentDay) < 0) {
            donationBtn.current.classList.remove("btn-primary");
            donationBtn.current.classList.add("btn-disabled");
        }
    }, []);

    const currency = new Intl.NumberFormat("id-ID");

    return (
        <div className="min-h-screen bg-slate-50">
            <Head title={props.title} />
            <Header />
            <div className="hidden lg:block">
                <Navbar auth={props.auth} />;
            </div>
            <div className="container mx-auto gap-2 mb-16 lg:mt-16">
                {/* Title */}
                <div className="card lg:card-side w-full bg-base-100 shadow-xl">
                    <figure>
                        <img
                            src={"/storage/" + props.campaign.cover}
                            alt="Campaign"
                            className="w-full lg:w-96"
                        />
                    </figure>
                    <div className="card-body">
                        <Link href={"/detail/campaign/" + props.campaign.slug}>
                            <h2 className="card-title font-bold">
                                {props.campaign.title}
                            </h2>
                        </Link>
                        <div className="text-sm flex flex-row items-center gap-2">
                            {props.campaign.user.company.company_name}
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
                        <p>{props.campaign.caption}</p>
                        <progress
                            className="progress progress-primary w-full"
                            value={(collected / target) * 100}
                            max="100"
                        ></progress>
                        <div className="flex flex-row justify-between">
                            <div className="flex flex-col">
                                <div className="text-xl font-bold">
                                    {"Rp " +
                                        currency.format(
                                            props.campaign.collected
                                        )}
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
                                    {parseInt(differentDay) < 0
                                        ? ""
                                        : "Hari Lagi"}
                                </div>
                            </div>
                        </div>
                        <div className="card-actions justify-center lg:justify-end">
                            <button
                                ref={donationBtn}
                                className="btn btn-wide btn-primary"
                            >
                                <Link href={"/donation/" + props.campaign.id}>
                                    Donasi Sekarang
                                </Link>
                            </button>
                        </div>
                    </div>
                </div>

                <BackButton />

                <div className="w-full">
                    <div>
                        {/* Description */}
                        <div className="relative bg-base-100 my-8">
                            <div className="sticky top-0 lg:top-16 py-2 text-center border border-base-300 rounded-sm bg-base-100 shadow-md text-xl font-bold w-full z-20">
                                Deskripsi Program
                            </div>
                            <div
                                dangerouslySetInnerHTML={desc}
                                className="p-6"
                            ></div>
                        </div>

                        {/* Contact */}
                        <div className="relative bg-base-100 my-8">
                            <div className="sticky top-0 lg:top-16 py-2 text-center border border-base-300 rounded-sm bg-base-100 shadow-md text-xl font-bold w-full z-20">
                                Kontak Kami
                            </div>
                            <div className="p-6">
                                <p>
                                    Informasi lebih lanjut hubungi customer
                                    service kami:
                                </p>
                                <p>
                                    {props.campaign.cs.name} (
                                    <a
                                        target="_blank"
                                        href={
                                            "https://api.whatsapp.com/send/?phone=" +
                                            phoneNumber +
                                            "&text&type=phone_number&app_absent=0"
                                        }
                                    >
                                        {props.campaign.cs.phone}
                                    </a>
                                    )
                                </p>
                            </div>
                        </div>

                        {/* fundraising */}
                        <div className="relative bg-base-100 my-8">
                            <div className="sticky top-0 lg:top-16 py-2 text-center border border-base-300 rounded-sm bg-base-100 shadow-md text-xl font-bold w-full z-20">
                                Fundraiser
                            </div>
                            <div className="p-6">
                                <Fundraising
                                    fundraising={props.campaign.fundraising}
                                />
                            </div>
                        </div>

                        {/* News */}
                        <div className="relative bg-base-100 my-8">
                            <div className="sticky top-0 lg:top-16 py-2 text-center border border-base-300 rounded-sm bg-base-100 shadow-md text-xl font-bold w-full z-20">
                                Berita Terbaru
                            </div>
                            <div className="p-6">
                                <News props={props.campaign.news} />
                            </div>
                        </div>

                        {/* Donatur */}
                        <div className="relative bg-base-100 my-8">
                            <div className="sticky top-0 lg:top-16 py-2 text-center border border-base-300 rounded-sm bg-base-100 shadow-md text-xl font-bold w-full z-20">
                                Donatur
                            </div>
                            <div className="p-6">
                                <Donation props={props.campaign.donation} />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div className="hidden lg:block">
                <Footer />
            </div>
        </div>
    );
}
