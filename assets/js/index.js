

const initFunction = (function generateCard(){

    const initValues = {

        url: '../inventario/lib/controller.php',
    
    };
    
    const tableExits =  (  data  ) => { 

        $('#table-exits').DataTable({

        bAutoWidth: false,
        info: false,
        stripeClasses: [],
        responsive: true,
        serverSide: true,
        processing:true,
        ordering: false,
        paging: true,
        searching:false,
        ajax: {
            "type": "post",
            "url": initValues.url,
            "data": function (d) {
                d =  Object.assign(d,data)  
            }
        },
        // order: [
        //     [6, 'desc']
        // ],
        columns: [
           
            { "data": "color","render":function( data, type, resultRow, meta ){

                return `<div style="background-color:${resultRow["color"]}; border-radius:4px" class="label">&nbsp;</div>`

                }
            },
            { "data": "capacidad","render": 
                function( data, type, resultRow, meta ){

                    return `${resultRow["capacidad"]} ml`

                } 
            },
            { "data": "descripcion_material" },
            { "data": "descripcion_modelo" }, 
            { "data": "cantidad" }, 
            { "render":function( data, type, resultRow, meta ){

                return `<input type="number" step="1" min="0" max="${resultRow["cantidad"]}" class="form-control cantidadItems" name="${resultRow["id_item"]}" id="total${resultRow["id_item"]}" placeholder="#" >`

                }
             },        
            
          
                
        ],

    })
    }

    const ajax  = ( { data } ) => {

        console.log(data)
        return ajaxStatus = $.ajax({
            url: initValues.url,
            type: "POST",
            dataType: "json",
            data                    
        });

    }

    const getCounters = async () => {


        try {
            
            initValues.data = { index: "getCounters" };

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

    const getCategories = async () => {


        try {
            
            initValues.data = { index: "getCategories" };

            const res = await ajax( initValues );

            if( res ){

                const [baja, alta] = res;

                document.querySelector("#counter-alta").textContent  = alta;
                document.querySelector("#counter-baja").textContent  = baja;
               

            }

        } catch ( error ) {

            console.warn(error)

        }


    }

    const newItem = async() => {

        try {
            
            const formArray =  $("#formNewItem").serializeArray();

            initValues.data = { index: "insertNewItem",formArray };

            const res = await ajax( initValues );

            if( res ){
                
                getCounters();

                getCategories();

                document.querySelector("#modalNewItem .cancel-submit").click()         

            }

        } catch (error) {
            
            console.warn(error)

        }
        

    }
  
    const itemExit = async() =>{


        try {
            const id_calidad = $("#selectCalidadExits").select2("data")[0].text

            const inputArray = $("#formExits .cantidadItems").serializeArray();

            const input = []
           
          
            initValues.data = { index: "setExits", inputArray, id_calidad };

            const res = await ajax( initValues );

            if( res ){

                $('#table-exits').DataTable().ajax.reload();

                getCounters();
                
                getCategories();

                // document.querySelector("#modalExits .cancel-submit").click() 
            
            }

        } catch (error) {
            
            console.warn(error);

        }
       

    }

    $("#formExits").on("submit",itemExit);

    $("#selectCalidad").select2({

        tags: true,
        
        placeholder: "Tipo de calidad",

        dropdownParent: $("#modalNewItem"),
        
        ajax: ({
            url: initValues.url,
            type: "post",
            dataType: 'json',
            data: function (params) {           
                return {    
                    searchTerm: params.term, // search term

                    index: 'getCalidad',
                }
            },
        
            processResults: function (response) { 
                return {
                    results: response
                }
            },
        }),
        reateTag: function(params) {
                    
            var term = $.trim(params.term);
           
            if (term.lenght === '') {
                return null;
            }

            return {
                id: term,
                text: term,
                newTag: true
            };
        }

    }); 

    $("#selectCalidadExits").select2({
        
        placeholder: "Selecciona calidad",

        dropdownParent: $("#modalExits"),
        
        ajax: ({
            url: initValues.url,
            type: "post",
            dataType: 'json',
            data: function (params) {           
                return {    
                    searchTerm: params.term, // search term

                    index: 'getCalidad',
                }
            },
        
            processResults: function (response) { 
                return {
                    results: response
                }
            },
        }),
      

    }); 

    $("#selectModelo").select2({

        tags: true,
        
        placeholder: "Tipo de modelo",

        dropdownParent: $("#modalNewItem"),
        
        ajax: ({
            url: initValues.url,
            type: "post",
            dataType: 'json',
            data: function (params) {           
                return {    
                    searchTerm: params.term, // search term

                    index: 'getModelo',
                }
            },
        
            processResults: function (response) { 
                return {
                    results: response
                }
            },
        }),
        reateTag: function(params) {
                    
            var term = $.trim(params.term);
           
            if (term.lenght === '') {
                return null;
            }

            return {
                id: term,
                text: term,
                newTag: true
            };
        }

    });

    $("#selectMaterial").select2({

        tags: true,
        
        placeholder: "Tipo de material",

        dropdownParent: $("#modalNewItem"),
        
        ajax: ({
            url: initValues.url,
            type: "post",
            dataType: 'json',
            data: function (params) {           
                return {    
                    searchTerm: params.term, // search term

                    index: 'getMaterial',
                }
            },
        
            processResults: function (response) { 
                return {
                    results: response
                }
            },
        }),
        reateTag: function(params) {
                    
            var term = $.trim(params.term);
           
            if (term.lenght === '') {
                return null;
            }

            return {
                id: term,
                text: term,
                newTag: true
            };
        }

    });


    return {

        ajax,
        counters: getCounters,
        insertItem: newItem,
        tableExits,
        itemExit,
        getCategories
        
    }


})()
initFunction.getCategories();
initFunction.counters();

$("#modalNewItem").on("hidden.bs.modal",()=>{

    $("#formNewItem").trigger("reset")

    $("#selectCalidad,#selectModelo,#selectMaterial").val(null).trigger("change")

})

$("#modalExits").on("hidden.bs.modal",()=>{

    $("#formNewItem").trigger("reset")

})

$("#selectCalidadExits").on("change",async function(){

    const id_calidad = $("#selectCalidadExits").val()
    if( $.fn.DataTable.isDataTable('#table-exits')){


        await $('#table-exits').DataTable().destroy()
        initFunction.tableExits( data = { index: "getTableExits",id_calidad })


    }else{

        initFunction.tableExits( data = { index: "getTableExits",id_calidad })

    }
   
    // initFunction.tableExits( data = { index: "getTableExits", id_calidad: $("#selectCalidadExits").val() })

    
})





