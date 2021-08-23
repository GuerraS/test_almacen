const initFunction = () => {

    
    const ajax  = ( { data, method  } ) => {

        return ajaxStatus = $.ajax({
            url: '../inventario/lib/controller.php',
            type: method,
            dataType: "json",
            data                    
        });

    };

    const getCounters  =  () => {


        try {
            
            initValues.data = { index: "getCounters", method: "GET"};

            const res = await ajax( initValues );

            if( res ){

                const [entries, exits, cat, total] = res;

                document.querySelector("#in-counter").textContent  = entries;
                document.querySelector("#out-counter").textContent  = exits;
                document.querySelector("#categorie-counter").textContent  = cat;
                document.querySelector("#total-counter").textContent  = total;



            }

        } catch ( error ) {

            console.warn(error)

        }


    }

    const newItem = () => {


        initValues.data = { index: "newItem", method: "POST"};
        

    }

    return {

        ajax,
        counters: getCounters

    }


}

export default initFunction