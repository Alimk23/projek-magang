import { Link } from "@inertiajs/inertia-react";

const Paginator = ({ meta }) => {
    const prev = meta.links[0].url;
    const next = meta.links[meta.links.length - 1].url;
    const current = meta.current_page;
    const last = meta.last_page;
    return (
        <div className="btn-group">
            {prev ? (
                <button className="btn text-xl">
                    <Link href={prev}>«</Link>
                </button>
            ) : (
                <button className="btn btn-disabled text-xl">«</button>
            )}
            <button className="btn">
                {current} / {last}
            </button>
            {next ? (
                <button className="btn text-xl">
                    <Link href={next}>»</Link>
                </button>
            ) : (
                <button className="btn btn-disabled text-xl">»</button>
            )}
        </div>
    );
};

export default Paginator;
