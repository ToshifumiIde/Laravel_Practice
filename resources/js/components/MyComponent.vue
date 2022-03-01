<template>
    <div class="container">
        <p>{{ msg }}</p>
        <hr />
        <ul>
            <li v-for="(person, key) in people">
                {{ person.id }}: {{ person.name }} [{{ person.mail }}]({{
                    person.age
                }})
            </li>
        </ul>
    </div>
</template>

<script>
const axios = require("axios");
export default {
    mounted() {
        axios.get("/hello/json").then((response) => {
            this.people = response.data;
            this.msg = "get data";
        });
    },
    data: function () {
        return {
            msg: "wait...",
            name: "",
            people: [],
        };
    },
    methods: {
        doAction: function () {
            this.msg = "Hello, " + this.name + "!!";
        },
    },
};
</script>
