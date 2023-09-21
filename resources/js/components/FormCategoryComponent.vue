<template>
    <div>
        <div>
            <form action="/post/category" method="post">
                <label for="category">大項目</label>
                <input type="text" name="category" id="category">
                <input type="submit" value="送信" class="btn btn-dark">
                <input type="hidden" name="_token" :value="csrf">
            </form>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                test: true,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            };
        },
        methods: {
            test() {
                return true;
            }
        }
    }

</script>