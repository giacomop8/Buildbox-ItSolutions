function trocar_cor() {
    document.addEventListener("DOMContentLoaded", function() {

        var categoria = document.querySelector('.titulo_arch_categoria').innerText.trim();

        var menuLinks = document.querySelectorAll('#menu ul li a');
        var categorias_mobile = document.querySelectorAll('#categorias_mobile div a');
        var categorias_mobile_svgs = document.querySelectorAll('#categorias_mobile div svg');

        menuLinks.forEach(function(link) {
            if (link.innerText.trim() === categoria) {
                link.style.color = 'red';
            }
        });
        
        categorias_mobile.forEach(function(link, index) {
            if (link.innerText.trim() === categoria) {
                link.style.color = 'red';
                var svgPaths = categorias_mobile_svgs[index].querySelectorAll('path');
                svgPaths.forEach(function(path) {
                    path.style.fill = 'red';
                });
            }
        });

    });
}
