;ОСНОВНАЯ ФУНКЦИЯ, которая выполняет алгоритм
;функция ford-falkerson, аргументы - (исток, сток, текущая_вершина, список_меток, список_дуг_графа, суммарный_поток, необязательный аргумент:вершины-тупики)
(defun ford-falkerson (s goal i marks net f &optional ends)
  (cond
    ;если список меток пуст, то выводим в качестве результата суммарный поток
    ((null marks) f)
	;если текущая вершина - целевая
    ((eq i goal)
	 ;то вызываем рекурсивно эту же функцию с параметрами:
	 ;(тот_же_самый_исток, тот_же_самый_сток, текущая_вершина-исток, в_список_меток_входит_только_метка_истока, 
	 ;обновленные_остаточные_пропускные_способности_дуг_графа, к_потоку_прибавляется_поток_полученного_на_предыдущих_шагах_дополняющего_пути, список_тупиков_пуст)
	 (ford-falkerson
	   s
	   goal
	   s
	   (list (car marks))
	   (append (updatenet (cdr marks) (flow (cdr marks))) (diff net (cdr marks)))
	   (+ f (flow (cdr marks)))))
	;если у текущей вершины есть допустимые направления
    ((diff (alloweddirections i net marks) ends)
	 ;то вызываем рекурсивно эту же функцию с параметрами:
	 ;(тот_же_самый_исток, тот_же_самый_сток, текущая_вершина-та_в_которую_ведет_дуга_с_макс_пропускной_способностью, 
	 ; в_метки_добавлена_текущая_дуга_и_обратная_ей, список_дуг_графа_не_меняется, поток_не_меняется, тупики_не_меняются)
	 (ford-falkerson
	    s
		goal
        (second (maxdirection (diff (alloweddirections i net marks) ends)))
	    (append marks
		  (list
		    (maxdirection (diff (alloweddirections i net marks) ends))
			(converseedge (maxdirection (diff (alloweddirections i net marks) ends)) net)))
		net
		f
		ends))
	;иначе (в случае тупиковой вершины) вызываем рекурсивно эту же функцию с параметрами:
	;(исток, сток, текущая_вершина-предыдущая, убираем_две_последние_метки, список_дуг_графа_не_меняется, 
	; поток_не_меняется, в_тупики_добавляем_вершину_из_которой_не_нашлось_допустимого_пути)
	(t (ford-falkerson s goal (cadar (last marks)) (reverse (cddr (reverse marks))) net f (cons (cadr (reverse marks)) ends)))))

	
;далее описываются вспомогательные функции, вызываемые непосредственно из функции ford-falkerson

;функция, результатом которой является список дуг, по которым разрешено двигаться из текущей вершины
;функция допустимые_направления (текущая вершина, список всех дуг графа(т.е остаточная сеть), список уже отмеченных(пройденных) дуг)
(defun alloweddirections (root net marks)
  (cond
    ;если не осталось нерассмотренных дуг графа, то результат пустой список (именно так выглядит условие завершения рекурсии)
    ((null net) nil)
	;если
    ((and
	    ;берем первую дугу из списка дуг графа, смотрим вершину, из которой выходит дуга (первый элемент), если он совпадает с текущей вершиной
		(eq root (caar net))
		;и если пропускная способность этой дуги (третий элемент) положительная
	    (plusp (third (car net)))
		;и если вершины в которую следует дуга (второго элемента дуги) нет в отмеченных
		(not (assoc (second (car net)) marks)))
	  ;то эта первая дуга является одним из допустимых направлений, далее проверяем таким же способом каждую дугу графа
	  (cons (car net) (alloweddirections root (cdr net) marks)))
	;если хотя бы одно из перечисленных выше условий невыполнено, то проверяем таким же способом оставшиеся дуги графа
	(t (alloweddirections root (cdr net) marks))))

	
;функция, результатом которой является список пропускных способностей (третих элементов) заданных дуг
;функция только_мощности (направления)
(defun onlycapacities (directions)
  (cond
    ((null directions)  nil)
    (t (cons (third (car directions)) (onlycapacities (cdr directions))))))

	
;функция, результатом которой является направление с максимальной пропускной способностью из заданных направлений
(defun maxdirection (directions)
	(nth (position (apply 'max (onlycapacities directions)) (onlycapacities directions)) directions))


;функция, результатом которой является обратная дуга для заданной дуги
;функция обратная_дуга (дуга, список_дуг_графа(или остаточная сеть))
(defun converseedge (edge net)
  ;ищем ту дугу, которая выражает обратное направление для данной дуги, например для (1 4 10) получаем (4 1 0)
  (cond
	((equal (cdr (reverse edge)) (reverse (cdr (reverse (car net)))))
	 (car net))
	(t (converseedge edge (cdr net)))))


;функция,результатом которой является разность между множествами A и B, т.е. все элементы A минус те, которые есть в B
(defun diff (A B)
  (cond
    ((null A) nil)
	((null B) A)
	;для каждой дуги из A проверяем есть ли она в B, если есть - t (true), то эта дуга в результат не входит
	((member t (mapcar #'(lambda (x) (equal x (car A))) B)) (diff (cdr A) B))
	(t (cons (car A) (diff (cdr A) B)))))


;функция, результатом которой являются дуги с пропускными способностями, обновленными на основе величины текущего потока
;например, путь состоит из дуг (1 3 30) и (3 5 20), а поток равен 20, то результат - ((1 3 10) (3 5 0) (3 1 20) (5 3 20))
(defun updatenet (marks flow)
  (cond
    ((null marks) nil)
	(t
	(cons
	 (append
	   (reverse (cdr (reverse (car marks))))
	   (list (- (third (car marks)) flow)))
	(cons
	 (append
	   (reverse (cdr (reverse (cadr marks))))
	   (list (+ (third (cadr marks)) flow)))
	 (updatenet (cddr marks) flow))))))


;функция принимает на вход метки(marks), и из них выбирает четные, т.е те, которые составляют путь из истока в сток
;например, в метках хранится ((1 3 30) (3 1 0) (3 5 20) (5 3 0)), т.е включая обратные дуги, то путь - это ((1 3 30) (3 5 20))
(defun path (marks)
  (cond
    ((null marks) nil)
	(t (cons (car marks) (path (cddr marks))))))


;поток - минимальная пропускная способность дуг пути
(defun flow (marks)
  (apply 'min (onlycapacities (path marks))))
  
  
;функия, которая создает переменную *дуги*, используя список дуг графа, хранящийся в файле
(defun readedges (stream)
  (labels
  ( (f1 (stream)
      (f2 (read stream nil nil)))
	(f2 (line)
	  (cond
        ((null line) nil)
        (t (cons line (f1 stream))))))
    (setq *edges* (f1 stream))))  

;функция, которая запускает выполнение алгоритма (функцию ford-falkerson с необходимыми параметрами), пользователю необходимо указать только исток и сток
(defun frontend (istok stok)
  (ford-falkerson istok stok istok (list (cons 'previous (cons istok (list 'mark 'direction)))) *edges* 0))

;аргумент функции readedges - имя файла в котором хранится список дуг
(readedges (open "C:/examples/1.txt"))

;например:
(frontend 1 5)
;результат:
60



;примеры графов, представленные в отчете:
(setf *edges*
  '((1 4 10) (1 2 20) (1 3 30) (2 3 40) (2 5 30) (3 4 10) (3 5 20) (4 5 20)
    (4 1 0) (2 1 0) (3 1 0) (3 2 0) (5 2 0) (4 3 0) (5 3 0) (5 4 0)))
(frontend 1 5)
;ответ:60 https://youtu.be/u9NigdVHUr0

(setf *edges*
  '((s a 10) (s c 10) (a b 4) (c d 9) (a c 2) (a d 8) (d b 6) (b t 10) (d t 10)
    (a s 0) (c s 0) (b a 0) (d c 0) (c a 0) (d a 0) (b d 0) (t b 0) (t d 0)))
(frontend 's 't)
;ответ:19 https://www.youtube.com/watch?v=Tl90tNtKvxs



;далее другие примеры графов:
;(вершина из которой выходит дуга, вершина в которую идет дуга, пропускная способность этой дуги)
;(обратному направлению дуг приписываем ноль в качестве пропускной способности)
(setf *edges*
  '((1 3 6) (3 5 9) (5 7 7) (7 8 4) (1 2 6) (2 4 4) (4 6 4) (6 8 7) (3 2 5) (2 5 2) (5 4 8) (4 7 2) (7 6 11)
    (3 1 0) (5 3 0) (7 5 0) (8 7 0) (2 1 0) (4 2 0) (6 4 0) (8 6 0) (2 3 0) (5 2 0) (4 5 0) (7 4 0) (6 7 0)))
(frontend 1 8)
;ответ:11
   
(setf *edges*
  '((0 1 39) (4 7 44) (6 3 33) (5 7 53) (0 2 10) (4 2 18) (6 7 95) (5 4 16) (0 3 23) (2 5 61) (2 1 81) (6 5 71) (1 4 25) (2 6 15) (3 2 20)
    (1 0 0) (7 4 0) (3 6 0) (7 5 0) (2 0 0) (2 4 0) (7 6 0) (4 5 0) (3 0 0) (5 2 0) (1 2 0) (5 6 0) (4 1 0) (6 2 0) (2 3 0)))
(frontend 0 7)
;ответ:55 http://kontromat.ru/?page_id=5504

(setf *edges*
  '((a b 5) (a c 4) (a d 2) (b e 5) (b c 1) (b f 3) (c e 4) (c f 1) (d f 1) (d c 2) (e g 5) (f g 8)
    (b a 0) (c a 0) (d a 0) (e b 0) (c b 0) (f b 0) (e c 0) (f c 0) (f d 0) (c d 0) (g e 0) (g f 0)))
(frontend 'a 'g)
;ответ:10

(setf *edges*
 '((a t 3) (a b 8) (s b 10) (b t 10) (s a 5)
   (t a 0) (b a 0) (b s 0) (t b 0) (a s 0)))
(frontend 's 't)
;ответ:13 https://www.youtube.com/watch?v=xDMbCTEmiXw

(setf *edges*
 '((s o 3) (s p 3) (o p 2) (o q 3) (p r 2) (q r 4) (r z 3) (q z 2)
   (o s 0) (p s 0) (p o 0) (q o 0) (r p 0) (r q 0) (z r 0) (z q 0)))
(frontend 's 'z)
;ответ:5