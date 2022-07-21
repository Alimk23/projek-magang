import BackButton from "@/Components/BackButton";
import React, { useState } from "react";

const getBank = (props) => {
    return props.map((data, i) => {
        return (
            <>
                <option key={i} defaultValue={data.id}>
                    {data.bank_name}
                </option>
            </>
        );
    });
};

const Create = (props) => {
    console.log(props.csrf);
    const [nominal, setNominal] = useState("");
    const [methode, setMethode] = useState("");
    const [name, setName] = useState("");
    const [phone, setPhone] = useState("");
    const [message, setMessage] = useState("");

    const handleSubmit = () => {};

    return (
        <div className="container sm:container-fluid mx-auto">
            <div className="navbar top-0 fixed z-50 bg-primary text-primary-content">
                <div className="flex flex-row items-center">
                    <BackButton />
                    <h1 className="ml-14">{props.campaign.title}</h1>
                </div>
            </div>
            <form action="/donation" method="post">
                <div className="flex justify-center my-16">
                    <div className="card w-96 bg-base-100 shadow-xl">
                        {/* <div className="card-title">Pilihan Nominal:</div> */}
                        <div className="card-body gap-4">
                            <div className="font-bold">Pilihan Nominal</div>
                            <div className="grid grid-cols-2 gap-2 w-full">
                                <div className="flex flex-row items-center">
                                    <label className="cursor-pointer">
                                        <input
                                            id="nominal1"
                                            type="radio"
                                            onChange={(nominal) =>
                                                setNominal(nominal.target.value)
                                            }
                                            defaultValue="1000000"
                                            className="radio checked:bg-blue-900"
                                            checked
                                        />
                                    </label>
                                    <span
                                        htmlFor="nominal1"
                                        className="ml-2 label-text"
                                    >
                                        Rp 1.000.000
                                    </span>
                                </div>
                                <div className="flex flex-row items-center">
                                    <label className="cursor-pointer">
                                        <input
                                            id="nominal2"
                                            type="radio"
                                            onChange={(nominal) =>
                                                setNominal(nominal.target.value)
                                            }
                                            defaultValue="500000"
                                            className="radio checked:bg-blue-900"
                                        />
                                    </label>
                                    <span
                                        htmlFor="nominal2"
                                        className="ml-2 label-text"
                                    >
                                        Rp 500.000
                                    </span>
                                </div>
                                <div className="flex flex-row items-center">
                                    <label className="cursor-pointer">
                                        <input
                                            id="nominal3"
                                            type="radio"
                                            onChange={(nominal) =>
                                                setNominal(nominal.target.value)
                                            }
                                            defaultValue="250000"
                                            className="radio checked:bg-blue-900"
                                        />
                                    </label>
                                    <span
                                        htmlFor="nominal3"
                                        className="ml-2 label-text"
                                    >
                                        Rp 250.000
                                    </span>
                                </div>
                                <div className="flex flex-row items-center">
                                    <label className="cursor-pointer">
                                        <input
                                            id="nominal4"
                                            type="radio"
                                            onChange={(nominal) =>
                                                setNominal(nominal.target.value)
                                            }
                                            defaultValue="100000"
                                            className="radio checked:bg-blue-900"
                                        />
                                    </label>
                                    <span
                                        htmlFor="nominal4"
                                        className="ml-2 label-text"
                                    >
                                        Rp 100.000
                                    </span>
                                </div>
                                <div className="flex flex-row items-center">
                                    <label className="cursor-pointer">
                                        <input
                                            id="nominal5"
                                            type="radio"
                                            onChange={(nominal) =>
                                                setNominal(nominal.target.value)
                                            }
                                            defaultValue="50000"
                                            className="radio checked:bg-blue-900"
                                        />
                                    </label>
                                    <span
                                        htmlFor="nominal5"
                                        className="ml-2 label-text"
                                    >
                                        Rp 50.000
                                    </span>
                                </div>
                                <div className="flex flex-row items-center">
                                    <label className="cursor-pointer">
                                        <input
                                            id="nominal6"
                                            type="radio"
                                            onChange={(nominal) =>
                                                setNominal(nominal.target.value)
                                            }
                                            defaultValue="25000"
                                            className="radio checked:bg-blue-900"
                                        />
                                    </label>
                                    <span
                                        htmlFor="nominal6"
                                        className="ml-2 label-text"
                                    >
                                        Rp 25.000
                                    </span>
                                </div>
                                <div className="flex flex-row items-center">
                                    <label className="cursor-pointer">
                                        <input
                                            id="nominal7"
                                            type="radio"
                                            onChange={(nominal) =>
                                                setNominal(nominal.target.value)
                                            }
                                            defaultValue="10000"
                                            className="radio checked:bg-blue-900"
                                        />
                                    </label>
                                    <span
                                        htmlFor="nominal6"
                                        className="ml-2 label-text"
                                    >
                                        Rp 10.000
                                    </span>
                                </div>
                                <div className="flex flex-row items-center">
                                    <label className="cursor-pointer">
                                        <input
                                            id="nominal8"
                                            type="radio"
                                            onChange={(nominal) =>
                                                setNominal(nominal.target.value)
                                            }
                                            className="radio checked:bg-blue-900"
                                        />
                                    </label>
                                    <span
                                        htmlFor="nominal8"
                                        className="ml-2 label-text"
                                    >
                                        Lainnya
                                    </span>
                                </div>
                            </div>

                            <div className="font-bold">
                                Pilih Metode Pembayaran
                            </div>
                            <div className="flex flex-row items-center">
                                <select
                                    onChange={(methode) =>
                                        setMethode(methode.target.value)
                                    }
                                    className="select select-primary w-full max-w-xs"
                                >
                                    <option disabled selected>
                                        Pilih Metode Pembayaran
                                    </option>
                                    {getBank(props.banks)}
                                </select>
                            </div>
                            <div className="font-bold">Nama</div>
                            <div className="flex flex-row items-center">
                                <input
                                    type="text"
                                    onChange={(name) =>
                                        setName(name.target.value)
                                    }
                                    className="input input-bordered input-primary w-full max-w-xs"
                                />
                            </div>
                            <div className="font-bold">Nomor HP</div>
                            <div className="flex flex-row items-center">
                                <input
                                    type="text"
                                    onChange={(phone) =>
                                        setPhone(phone.target.value)
                                    }
                                    className="input input-bordered input-primary w-full max-w-xs"
                                />
                            </div>
                            <div className="font-bold">Pesan</div>
                            <textarea
                                onChange={(message) =>
                                    setMessage(message.target.value)
                                }
                                className="textarea textarea-primary"
                                placeholder="Optional"
                            ></textarea>
                            <div className="btm-nav bottom-0">
                                <button
                                    onClick={() => handleSubmit()}
                                    className="btn btn-primary"
                                >
                                    Lanjut Pembayaran
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    );
};

export default Create;
