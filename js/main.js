function getInfected(data){
        var yValues = [];
        for (let i = 0; i < data.length; i++) {
            yValues.push(Number(data[i]));
        }
        console.log(yValues);
}

// getInfected(data)