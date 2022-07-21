import React from "react";
import { Head } from "@inertiajs/inertia-react";
import Navbar from "@/Components/Navbar";
import CampaignList from "@/Components/Homepage/CampaignList";
import Paginator from "@/Components/Paginator";
import Header from "@/Components/Header";
import Footer from "@/Components/Footer";

export default function Homepage(props) {
    return (
        <div className="min-h-screen bg-slate-50">
            <Head title={props.title} />
            <Header />
            <Navbar auth={props.auth} />;
            <div className="gap-2 my-16 flex flex-col justify-center items-center lg:flex-row lg:flex-wrap lg:justify-center lg:items-stretch">
                <CampaignList campaign={props.campaign.data} />
            </div>
            <div className="gap-4 mb-24 flex flex-col justify-center items-center">
                <Paginator meta={props.campaign.meta} />
            </div>
            <div className="hidden lg:block">
                <Footer />
            </div>
        </div>
    );
}
