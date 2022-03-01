import axios from "axios";
import React, { useState } from "react";
import ReactDOM from "react-dom";

export const MyComponent = () => {
    const [num, setNum] = useState(0);
    const [msg, setMsg] = useState("ok");
    const [person, setPerson] = useState(null);
    const doAction = () => {
        axios.get("hello/json/" + num).then((res) => {
            let person = res.data;
            let msg =
                person.id +
                ":" +
                person.name +
                "[" +
                person.mail +
                "] (" +
                person.age +
                ")";
            setMsg(msg);
            setPerson(person);
        });
    };

    return (
        <div className="container">
            <p>{msg}</p>
            <div className="">
                <input
                    type="number"
                    id="num"
                    value={num}
                    onChange={(e) => {
                        setNum(e.target.value);
                    }}
                />
                <button
                    onClick={() => {
                        setPerson({ num });
                        setMsg("wait...");
                        doAction();
                    }}
                >
                    検索
                </button>
            </div>
        </div>
    );
};

// viewにid="mycomponent"がある場合に、ReactDOM.render()を走らせる
if (document.getElementById("mycomponent")) {
    ReactDOM.render(<MyComponent />, document.getElementById("mycomponent"));
}
