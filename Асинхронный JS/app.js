
// функция для асинхронного получения данных
const whereAmI = async function(country){

    const box = document.querySelector('.box'); // получаем родителя для вставки

    const res = await fetch(`https://restcountries.com/v3.1/name/${country}`); // запрос данных с удаленного сервера

    const data = await res.json();// получаю данные JSON
    console.log(data);

    console.log(data[0].coatOfArms.svg);

    const bordersArr = data[0].borders; // кладем массив с соседями в переменную
    const bordersArrHTML = bordersArr.map( function(item){ // перебираем массив через map
        return `<span class='border'>${item}</span>`; // каждому элементу исходного массива добавляем разметку
    } ); // в результате работы метода map получится массив строк с разметкой и данными
    //console.log(bordersArrHTML); // массив  строк
    const bordersArrHTMLStr = bordersArrHTML.join(' '); // получаем из массива строк одну большую строку с разметкой и данными
    

    const bordersStr = bordersArr.join(', '); // преобразовываем массив в строку с разд ', '

    const timeZonesStr = data[0].timezones.join(', '); // получаем строку с временными зонами
    const coatOfArms = data[0].coatOfArms.png; // получаю ссылку на изображение герба
    const flag = data[0].flags.png; // флаг
    
    const boxContent = `
        <h2>Моя родная страна: <span>${data[0].altSpellings[2]}</span></h2>
        <h3>Площадь: <span>${data[0].area} кв.км.</span></h3>
        <p>Столица: <span>${data[0].capital} </span> </p>
        <p>Континент: <span>${data[0].continents}</span></p>
        <p>Население: <span>${data[0].population} человек</span></p>
        <p>Первый день недели: <span>${data[0].startOfWeek} </span></p>
        <p>Временные зоны: <span>${timeZonesStr} </span></p>
        <p>Соседние страны: ${bordersArrHTMLStr}</p>
        <div class="country-image">
            <img class="image" src="${coatOfArms}" alt="Герб страны ${data[0].altSpellings[2]}">
            <img class="image" src="${flag}" alt="Флаг страны ${data[0].altSpellings[2]}">
        </div>
    `;

    box.insertAdjacentHTML('afterbegin', boxContent); // помещаем готовую разметку на страницу

}

whereAmI('russia');
whereAmI('peru');
console.log('Hello');



// массив data похож на структуру ниже
data = [
    {
        area: 17098242,
        fifa: "RUS",
        flag: "🇷🇺",
        borders: ['AZE', 'BLR', 'CHN', 'EST', 'FIN', 'GEO', 'KAZ'],
        independent: true,
        population: 144104080,
        region: "Europe",
        startOfWeek: "monday",
        status: "officially-assigned",
        subregion: "Eastern Europe",
        unMember: true
    },
    {
        area: 17098,
        fifa: "BWE",
        flag: "fg",
        borders: ['DSE', 'RTY'],
        independent: true,
        population: 104080,
        region: "Europe",
        startOfWeek: "monday",
        status: "officially-assigned",
        subregion: "Eastern Europe",
        unMember: true
    }
];