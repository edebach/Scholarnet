PGDMP     .                    {        
   Scholarnet    15.2    15.2                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    16398 
   Scholarnet    DATABASE        CREATE DATABASE "Scholarnet" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Italian_Italy.1252';
    DROP DATABASE "Scholarnet";
                postgres    false            �            1259    40960    corso    TABLE     �   CREATE TABLE public.corso (
    codice character varying(8) NOT NULL,
    nome character varying(50) NOT NULL,
    materia character varying(50),
    "numeroIscritti" numeric(5,0),
    link character varying(100)
);
    DROP TABLE public.corso;
       public         heap    postgres    false            �            1259    40963    insegna    TABLE     v   CREATE TABLE public.insegna (
    docente character varying(25) NOT NULL,
    corso character varying(50) NOT NULL
);
    DROP TABLE public.insegna;
       public         heap    postgres    false            �            1259    40966 	   partecipa    TABLE     y   CREATE TABLE public.partecipa (
    studente character varying(25) NOT NULL,
    corso character varying(50) NOT NULL
);
    DROP TABLE public.partecipa;
       public         heap    postgres    false            �            1259    32836 
   recensione    TABLE     �   CREATE TABLE public.recensione (
    utente character varying(50) NOT NULL,
    data date NOT NULL,
    stelle character varying(5) NOT NULL,
    descrizione character varying(250) DEFAULT NULL::character varying
);
    DROP TABLE public.recensione;
       public         heap    postgres    false            �            1259    16399    utente    TABLE     L  CREATE TABLE public.utente (
    nome character varying(25) NOT NULL,
    cognome character varying(25) NOT NULL,
    email character varying(50) NOT NULL,
    pass character varying(25) NOT NULL,
    istituto character varying(50),
    sesso character varying(10) NOT NULL,
    "dataN" date NOT NULL,
    "flagStudente" boolean
);
    DROP TABLE public.utente;
       public         heap    postgres    false                      0    40960    corso 
   TABLE DATA           N   COPY public.corso (codice, nome, materia, "numeroIscritti", link) FROM stdin;
    public          postgres    false    216   p                 0    40963    insegna 
   TABLE DATA           1   COPY public.insegna (docente, corso) FROM stdin;
    public          postgres    false    217   �                 0    40966 	   partecipa 
   TABLE DATA           4   COPY public.partecipa (studente, corso) FROM stdin;
    public          postgres    false    218   �                 0    32836 
   recensione 
   TABLE DATA           G   COPY public.recensione (utente, data, stelle, descrizione) FROM stdin;
    public          postgres    false    215                    0    16399    utente 
   TABLE DATA           f   COPY public.utente (nome, cognome, email, pass, istituto, sesso, "dataN", "flagStudente") FROM stdin;
    public          postgres    false    214   J       z           2606    40970    corso corso_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.corso
    ADD CONSTRAINT corso_pkey PRIMARY KEY (codice);
 :   ALTER TABLE ONLY public.corso DROP CONSTRAINT corso_pkey;
       public            postgres    false    216            ~           2606    40972    partecipa pk_partecipa 
   CONSTRAINT     a   ALTER TABLE ONLY public.partecipa
    ADD CONSTRAINT pk_partecipa PRIMARY KEY (studente, corso);
 @   ALTER TABLE ONLY public.partecipa DROP CONSTRAINT pk_partecipa;
       public            postgres    false    218    218            x           2606    32841    recensione pk_recensione 
   CONSTRAINT     `   ALTER TABLE ONLY public.recensione
    ADD CONSTRAINT pk_recensione PRIMARY KEY (utente, data);
 B   ALTER TABLE ONLY public.recensione DROP CONSTRAINT pk_recensione;
       public            postgres    false    215    215            |           2606    40974    insegna primary_key 
   CONSTRAINT     ]   ALTER TABLE ONLY public.insegna
    ADD CONSTRAINT primary_key PRIMARY KEY (docente, corso);
 =   ALTER TABLE ONLY public.insegna DROP CONSTRAINT primary_key;
       public            postgres    false    217    217            v           2606    32771    utente utente_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.utente
    ADD CONSTRAINT utente_pkey PRIMARY KEY (email);
 <   ALTER TABLE ONLY public.utente DROP CONSTRAINT utente_pkey;
       public            postgres    false    214            �           2606    40975    insegna fk_corso    FK CONSTRAINT     q   ALTER TABLE ONLY public.insegna
    ADD CONSTRAINT fk_corso FOREIGN KEY (corso) REFERENCES public.corso(codice);
 :   ALTER TABLE ONLY public.insegna DROP CONSTRAINT fk_corso;
       public          postgres    false    217    216    3194            �           2606    40980    partecipa fk_corso    FK CONSTRAINT     s   ALTER TABLE ONLY public.partecipa
    ADD CONSTRAINT fk_corso FOREIGN KEY (corso) REFERENCES public.corso(codice);
 <   ALTER TABLE ONLY public.partecipa DROP CONSTRAINT fk_corso;
       public          postgres    false    3194    216    218            �           2606    40985    insegna fk_docente    FK CONSTRAINT     u   ALTER TABLE ONLY public.insegna
    ADD CONSTRAINT fk_docente FOREIGN KEY (docente) REFERENCES public.utente(email);
 <   ALTER TABLE ONLY public.insegna DROP CONSTRAINT fk_docente;
       public          postgres    false    217    3190    214                       2606    32842    recensione fk_recensione    FK CONSTRAINT     z   ALTER TABLE ONLY public.recensione
    ADD CONSTRAINT fk_recensione FOREIGN KEY (utente) REFERENCES public.utente(email);
 B   ALTER TABLE ONLY public.recensione DROP CONSTRAINT fk_recensione;
       public          postgres    false    215    3190    214            �           2606    40990    partecipa fk_studente    FK CONSTRAINT     y   ALTER TABLE ONLY public.partecipa
    ADD CONSTRAINT fk_studente FOREIGN KEY (studente) REFERENCES public.utente(email);
 ?   ALTER TABLE ONLY public.partecipa DROP CONSTRAINT fk_studente;
       public          postgres    false    3190    214    218               W   x��4���tu���KOM�K-�LT��K�/�M,�LN��M,I�4����w�I,.΄P��P}z\�a�A!����6$F��� #-�            x������ � �            x������ � �         )   x�K�Kq���,�4202�50�52�4�L�H�K����� ���         �   x�=�1�0Eg��@��d�V�0!�v1i�X
1�]�f�\����_��ʰO��[����v���3�$�'��k̢@ޣ��"�|4#ߋYV�(�C'�w_=i�-�*Q�E�I
W����z�ZpvƘ�,     