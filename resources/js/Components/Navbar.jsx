import { Link } from "@inertiajs/inertia-react";
const Navbar = (props) => {
    console.log(props);
    return (
        <>
            {/* Dekstop */}
            <div className="hidden fixed sm:block sm:bg-slate-100 sm:shadow-md top-0 left-0 right-0 z-50">
                <div className="navbar container mx-auto">
                    <div className="navbar-start">
                        <div className="dropdown">
                            <label
                                tabIndex="0"
                                className="btn btn-ghost lg:hidden"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    className="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M4 6h16M4 12h8m-8 6h16"
                                    />
                                </svg>
                            </label>
                            <ul
                                tabIndex="0"
                                className="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52"
                            >
                                <li>
                                    <Link href="">Item 1</Link>
                                </li>
                                <li tabIndex="0">
                                    <Link href="" className="justify-between">
                                        Parent
                                        <svg
                                            className="fill-current"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                        >
                                            <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                                        </svg>
                                    </Link>
                                    <ul className="p-2">
                                        <li>
                                            <Link href="">Submenu 1</Link>
                                        </li>
                                        <li>
                                            <Link href="">Submenu 2</Link>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <Link href="">Item 3</Link>
                                </li>
                            </ul>
                        </div>
                        <Link
                            href="/"
                            className="btn btn-ghost normal-case text-xl"
                        >
                            <img
                                src="/img/logo.png"
                                width="100px"
                                alt="Hobi Sedekah"
                            />
                        </Link>
                    </div>
                    <div className="navbar-center hidden lg:flex">
                        <ul className="menu menu-horizontal p-0">
                            <li>
                                <Link href="/">Beranda</Link>
                            </li>
                            <li>
                                <Link href="#sedekahprioritas">
                                    Program Berjalan
                                </Link>
                            </li>

                            <li tabIndex="0">
                                <Link href="">
                                    Kategori
                                    <svg
                                        className="fill-current"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="20"
                                        height="20"
                                        viewBox="0 0 24 24"
                                    >
                                        <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                                    </svg>
                                </Link>
                                <ul className="p-2">
                                    <li>
                                        <Link href="">Pendidikan</Link>
                                    </li>
                                    <li>
                                        <Link href="">Waqaf</Link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div className="navbar-end">
                        <Link
                            href="/register"
                            className="btn p-3 mx-1 btn-outline"
                        >
                            Register
                        </Link>
                        <Link
                            href="/login"
                            className="btn p-3 mx-1 hover:bg-slate-200 hover:text-black"
                        >
                            Login
                        </Link>
                    </div>
                </div>
            </div>

            {/* Mobile */}
            <div className="block sm:hidden fixed top-0 left-0 right-0 bg-slate-100 shadow-md z-50">
                <div className="navbar">
                    <div className="flex-1">
                        <Link
                            href="/"
                            className="btn btn-ghost normal-case text-xl"
                        >
                            <img
                                src="/img/logo.png"
                                width="100px"
                                alt="Hobi Sedekah"
                            />
                        </Link>
                    </div>
                    <div className="flex-none gap-2">
                        <div className="dropdown dropdown-end">
                            <label
                                tabIndex="0"
                                className="btn btn-ghost btn-circle avatar"
                            >
                                <div className="w-10 rounded-full">
                                    <img
                                        src="/img/default.png"
                                        alt="Akun"
                                        width="100px"
                                    />
                                </div>
                            </label>
                            <ul
                                tabIndex="0"
                                className="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52"
                            >
                                <li>
                                    <Link href="" className="justify-between">
                                        Profile
                                        <span className="badge">New</span>
                                    </Link>
                                </li>
                                <li>
                                    <Link href="">Settings</Link>
                                </li>
                                <li>
                                    <Link href="">Logout</Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div className="block fixed bg-slate-100 sm:hidden z-50">
                <div className="btm-nav">
                    <button className="active">
                        <Link href="/">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                className="h-5 w-5 mx-auto"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                />
                            </svg>
                            <span className="btm-nav-label">Beranda</span>
                        </Link>
                    </button>
                    <button>
                        <Link href="/category">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                className="h-6 w-6 mx-auto"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                strokeWidth="2"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16"
                                />
                            </svg>
                            <span className="btm-nav-label">Kategori</span>
                        </Link>
                    </button>
                    <button>
                        <Link href="/login">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                className="h-6 w-6 mx-auto"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                strokeWidth="2"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                />
                            </svg>
                            <span className="btm-nav-label">Akun</span>
                        </Link>
                    </button>
                </div>{" "}
            </div>
        </>
    );
};

export default Navbar;
