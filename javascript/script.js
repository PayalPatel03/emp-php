function toggleSidebar(){
    let sidebar = document.getElementById("sidebar");
    let main = document.getElementById("main");
    let arrow = document.getElementById("arrow");

    sidebar.classList.toggle("collapsed");
    main.classList.toggle("full");

    if(sidebar.classList.contains("collapsed")){
        arrow.classList.remove("fa-arrow-left-long");
        arrow.classList.add("fa-arrow-right-long");
    } else {
        arrow.classList.remove("fa-arrow-right-long");
        arrow.classList.add("fa-arrow-left-long");
    }
}

new Chart(document.getElementById('lineChart'),{
    type:'line',
    data:{
        labels:['Jan','Feb','Mar','Apr','May','Jun','Jul'],
        datasets:[{
            data:[10,20,15,30,22,28,25],
            borderColor:'#ff5e78',
            tension:0.4,
            fill:false
        }]
    },
    options:{plugins:{legend:{display:false}}}
});

new Chart(document.getElementById('pieChart'),{
    type:'doughnut',
    data:{
        labels:['Male','Female'],
        datasets:[{
            data:[60,40],
            backgroundColor:['#ff5e78','#5b3f8c']
        }]
    },
    options:{plugins:{legend:{display:false}}}
});