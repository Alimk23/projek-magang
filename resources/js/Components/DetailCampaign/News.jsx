const isNews = (props) => {
    return props.map((data, i) => {
        const dateNow = new Date();
        const createdDate = new Date(data.updated_at);
        const differentTime = dateNow.getTime() - createdDate.getTime();
        const differentDay = differentTime / (1000 * 3600 * 24);

        const currency = new Intl.NumberFormat("id-ID");

        return (
            <div key={i}>
                <div className="flex flex-col w-full">
                    <div className="flex flex-row justify-between w-full">
                        <div className="flex flex-col mx-3">
                            <div className="font-bold">{data.title}</div>
                            <p className="">
                                {parseInt(differentDay) + " hari yang lalu"}
                            </p>
                        </div>
                    </div>
                    <p className="mx-3 p-3 bg-slate-100 w-full">
                        {data.description}
                    </p>
                </div>
            </div>
        );
    });
};

const noNews = () => {
    return <div>Belum ada donatur yang tercatat</div>;
};

const News = ({ props }) => {
    return props.length == 0 ? noNews() : isNews(props);
};

export default News;
